<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Deliveries\DeliveryArea;
use App\Models\Deliveries\DeliveryLocation;
use App\Models\Products\Product;
use App\Models\Products\ProductCategory;
use App\Models\Sales\Sale;
use App\Models\Sales\SaleDelivery;
use App\Models\Sales\SaleItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDO;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        $count_users = User::whereNotIn('user_level', [0, 1])
            ->where('user_status', 1)
            ->count();
        $count_all_users = User::count();
    
        $messages = Message::latest()
            ->where('status', 0)
            ->take(5)
            ->get();
        $count_all_messages = Message::count();
    
        $count_products = Product::count();
        $count_product_categories = ProductCategory::count();
    
        $count_locations = DeliveryLocation::count();
        $count_areas = DeliveryArea::count();
    
        $count_sales = Sale::count();


        $databaseDriver = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);
        $monthFunction = match ($databaseDriver) {
            'sqlite' => "CAST(strftime('%m', created_at) AS INTEGER)",
            default => "MONTH(created_at)",
        };
        
        // Sales Statistics
        $gross_sales = Sale::sum('total_amount');
        $net_sales = Sale::sum('total_amount') - Sale::sum('discount');
        $cost_of_sales = SaleItem::sum('buying_price');
        $gross_profit = $net_sales - $cost_of_sales;
    
        // Sales for each month
        $monthly_sales = Sale::selectRaw("$monthFunction as month, SUM(total_amount) as total_sales")
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total_sales', 'month');
    
        $sales_data = [];
        for ($month = 1; $month <= 12; $month++) {
            $sales_data[] = $monthly_sales[$month] ?? 0;
        }


        $locations_data = SaleDelivery::select('location', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('location')
            ->orderBy('total_orders', 'desc')
            ->get();

        // Map the data for cities and orders
        $locations_labels = $locations_data->pluck('location')->toArray();
        $locations_orders = $locations_data->pluck('total_orders')->toArray();
    
        return view('dashboard.index', compact(
            'user',

            'count_users',
            'count_all_users',
            'count_products',
            'count_product_categories',
            'count_locations',
            'count_areas',
            'count_all_messages',
            'count_sales',

            'messages',
            'gross_sales',
            'net_sales',
            'cost_of_sales',
            'gross_profit',
            
            'sales_data',
            'locations_labels',
            'locations_orders',
        ));
    }
    
}
