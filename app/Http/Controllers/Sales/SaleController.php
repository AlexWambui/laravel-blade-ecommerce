<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Deliveries\DeliveryLocation;
use App\Models\Deliveries\DeliveryArea;
use App\Models\Sales\Sale;
use App\Models\Sales\SaleDelivery;
use App\Models\Sales\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('items', 'delivery', 'user')
            ->latest()
            ->get()
            ->sortBy([
                fn($sale) => $sale->delivery?->delivery_status === 'delivered' 
                            && $sale->amount_paid >= $sale->total_amount ? 1 : 0,
            ]);
    
        $count_sales = $sales->count();
        $count_delivered_sales = $sales->filter(fn($sale) => $sale->delivery?->delivery_status === 'delivered')->count();
        $count_pending_sales = $sales->filter(fn($sale) => $sale->delivery?->delivery_status === 'pending')->count();
    
        return view('admin.sales.index', compact('count_sales', 'count_delivered_sales', 'count_pending_sales', 'sales'));
    }

    public function edit(Sale $sale)
    {
        $amount_paid = $sale->amount_paid;
        $total_amount = $sale->total_amount;

        // Determine payment status
        if ($amount_paid == $total_amount) {
            $amount_paid_display = 'Paid';
        } elseif ($amount_paid < $total_amount) {
            $amount_paid_display = 'Underpaid';
        } else {
            $amount_paid_display = 'Overpaid';
        }

        return view('admin.sales.edit', compact('sale', 'amount_paid_display'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'delivery_status' => 'required|string|in:' . implode(',', SaleDelivery::DELIVERYSTATUS),
            'payment_method' => 'required|string|in:' . implode(',', SaleDelivery::PAYMENTMETHODS),
            'amount_paid' => 'required|numeric|min:0',
        ]);
    
        $amount_paid = $validated['amount_paid'];
    
        // Update sale details
        $sale->update([
            'amount_paid' => $amount_paid,
            'payment_method' => $validated['payment_method'],
        ]);
    
        // Update delivery details
        $sale->delivery()->update([
            'delivery_status' => $validated['delivery_status'],
        ]);
    
        return redirect()->back()->with('success', 'Sale details updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale has been deleted.');
    }

    public function checkoutCreate()
    {
        $cart = app(CartController::class)->cartItemsWithTotals();

        if (empty($cart['items'])) {
            return redirect()->route('shop-page')->withErrors(['cart' => 'Your cart is empty. Add items before proceeding to checkout.']);
        }

        $user = Auth::check() ? Auth::user() : null;
        $locations = DeliveryLocation::orderBy('name')->get();
        $areas = DeliveryArea::orderBy('name')->get();

        return view('shop.checkout', compact('areas', 'cart', 'locations', 'user'));
    }

    public function checkoutStore(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:200',
            'email' => 'required|string|lowercase|email:rfc,dns|max:255',
            'phone_number' => [
                'required',
                'string',
                'regex:/^(2547|2541)[0-9]{8}$/',
            ],
        ], [
            'phone_number.regex' => 'Phone number must start with 2547 or 2541 and have exactly 12 digits. (254746055xxx or 254116055xxx)',
        ]);
    
        $cart = app(CartController::class)->cartItemsWithTotals();
        $cart_items = $cart['items'];
        $cart_subtotal = $cart['subtotal'];
    
        if (empty($cart_items)) {
            return redirect()->route('shop-page')->withErrors(['cart' => 'Your cart is empty. Add items before proceeding to checkout.']);
        }
    
        $pickup_method = $request->input('pickup_method');
        $address = 'Shop';
        $location_name = 'Shop';
        $area_name = 'Shop';
        $shipping_cost = 0;
    
        if ($pickup_method === 'delivery') {
            $validated += $request->validate([
                'address' => 'required|string',
                'location' => 'required|exists:delivery_locations,id',
                'area' => 'required|exists:delivery_areas,id',
            ]);
    
            $address = $validated['address'];
            $location = DeliveryLocation::findOrFail($validated['location']);
            $area = DeliveryArea::findOrFail($validated['area']);
    
            $location_name = $location->name;
            $area_name = $area->name;
            $shipping_cost = $area->price;
        }
    
        $total_amount = $shipping_cost + $cart_subtotal;
        $order_number = 'O_' . Str::random(6) . '_' . date('dmy');
        $user_id = Auth::check() ? Auth::user()->id : null;
    
        try {
            DB::beginTransaction();
    
            // Create order
            $order = Sale::create([
                'order_number' => $order_number,
                'order_type' => 0,
                'discount_code' => null,
                'discount' => 0,
                'total_amount' => $total_amount,
                'payment_method' => null,
                'user_id' => $user_id,
            ]);
    
            // Insert order items
            foreach ($cart_items as $productId => $item) {
                SaleItem::create([
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'buying_price' => $item['buying_price'],
                    'selling_price' => $item['selling_price'],
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                ]);
            }
    
            // Insert delivery details
            SaleDelivery::create([
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'address' => $address,
                'location' => $location_name,
                'area' => $area_name,
                'shipping_cost' => $shipping_cost,
                'order_id' => $order->id,
            ]);
    
            // Commit transaction (save changes)
            DB::commit();
    
            Session::put('order_number', $order->order_number);
            Session::forget(['cart', 'cart_count']);
    
            return redirect()->route('checkout.success');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Checkout failed. Please try again.']);
        }
    }
    

    public function checkoutSuccess()
    {
        $order_number = session('order_number');

        return view('shop.success', compact('order_number'));
    }
}
