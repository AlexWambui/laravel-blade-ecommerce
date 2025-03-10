<x-authenticated-layout>
    <x-slot name="head">
        <title>Sale | Update</title>
    </x-slot>

    <section class="Sales">
        <div class="custom_form">
            <div class="header">
                <div class="icon">
                    <a href="{{ route('sales.index') }}">
                        <span class="fas fa-arrow-left"></span>
                    </a>
                </div>
                <p>Update Sale</p>
            </div>

            <form action="{{ route('sales.update', $sale->id) }}" method="post">
                @csrf
                @method('patch')

                <div class="order_details row_container">
                    <div class="details">
                        <p class="text-success">
                            <span>Order_number</span>
                            <span>{{ $sale->order_number ?? '-' }}</span>
                        </p>
                        <p>
                            <span>Names</span>
                            <span>{{ $sale->delivery->full_name ?? '-' }}</span>
                        </p>
                        <p>
                            <span>Email Address</span>
                            <span>{{ $sale->delivery->email ?? '-' }}</span>
                        </p>
    
                        <p>
                            <span>Phone Number</span>
                            <span>+{{ $sale->delivery->formatted_phone_number ?? '-' }}</span>
                        </p>
                        
                        <p>
                            <span>Address</span>
                            <span>{{ $sale->delivery->address ?? '-' }}</span>
                        </p>
                        <p>
                            <span>Location</span>
                            <span>{{ $sale->delivery->location ?? '-' }}</span>
                        </p>
                        <p>
                            <span>Area</span>
                            <span>{{ $sale->delivery->area ?? '-' }}</span>
                        </p>
                        <p>
                            <span>Order Date</span>
                            <span>{{ $sale->created_at?->format('d M Y \a\t h:i A') ?? '-' }}</span>
                        </p>
                    </div>
    
                    <div class="cart_items">
                        <p class="bold">Items Ordered</p>
    
                        <ol>
                            @foreach($sale->items as $product)
                            <li>
                                <span>{{ $product['name'] }} : </span>
                                <span>{{ $product['quantity'] }} @ {{ $product['selling_price'] }}</span>
                                <span>= Ksh. {{ number_format($product['selling_price'] * $product['quantity'], 2) }}</span>
                            </li>
                            @endforeach
                        </ol>
    
                        <p>
                            <span>Shipping Cost : </span>
                            <span>Ksh. {{ $sale->delivery->shipping_cost ?? '-' }}</span>
                        </p>
                        <p class="text-success bold">
                            <span>Total Amount : </span>
                            <span>Ksh. {{ number_format($sale->total_amount, 2) }}</span>
                        </p>
    
                        <div class="payment_details">
                            <p>
                                <span>Payment : </span>
                                <span>
                                    @if ($amount_paid_display == 'Paid')
                                        <i class="fa fa-check-circle title success"></i>
                                    @elseif ($amount_paid_display == 'Underpaid')
                                        <span class="danger title">Ksh. {{ number_format($sale->amount_paid ?? 0, 2) }}</span>
                                    @elseif ($amount_paid_display == 'Overpaid')
                                        <span class="success title">Ksh. {{ number_format($sale->amount_paid ?? 0, 2) }}</span>
                                    @else
                                        <span>{{ $sale->amount_paid ?? '-' }}</span>
                                    @endif
                                </span>
                            </p>

                            <p>
                                <span>Delivery :</span>
                                <span>
                                    @if($sale->delivery?->delivery_status == 'delivered')
                                        <i class="fa fa-check-circle success"></i>
                                    @else
                                        {{ ucfirst($sale->delivery?->delivery_status) }}
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="input_group_3">
                    <div class="inputs">
                        <label for="delivery_status">Delivery</label>
                        <div class="custom_radio_buttons">
                            @foreach(App\Models\Sales\SaleDelivery::DELIVERYSTATUS as $status)
                                <label>
                                    <input class="option_radio" 
                                        type="radio" 
                                        name="delivery_status" 
                                        value="{{ $status }}"
                                        {{ old('delivery_status', $sale->delivery?->delivery_status) == $status ? 'checked' : '' }}>
                                    <span>{{ ucfirst($status) }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error field="delivery_status" />
                    </div>

                    <div class="inputs">
                        <label for="payment_method">Payment Method</label>
                        <div class="custom_radio_buttons">
                            @foreach(App\Models\Sales\SaleDelivery::PAYMENTMETHODS as $method)
                                <label>
                                    <input class="option_radio" 
                                        type="radio" 
                                        name="payment_method" 
                                        value="{{ $method }}"
                                        {{ old('payment_method', $sale->payment_method) == $method ? 'checked' : '' }}>
                                    <span>{{ ucfirst($method) }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error field="payment_method" />
                    </div>

                    <div class="inputs">
                        <label for="amount_paid">Amount Paid</label>
                        <input type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', $sale->amount_paid) }}">
                    </div>
                </div>

                <div class="buttons">
                    <button type="submit">Update Sale</button>

                    @can('view-as-super-admin')
                        <button type="button" class="btn_danger" onclick="deleteItem({{ $sale->id }}, 'sale');"
                            form="deleteForm_{{ $sale->id }}">
                            <i class="fas fa-trash-alt delete"></i>
                            <span>Delete Sale</span>                        
                        </button>
                    @endcan
                </div>
            </form>

            @can('view-as-super-admin')
                <form id="deleteForm_{{ $sale->id }}" action="{{ route('sales.destroy', $sale->id) }}" method="post"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endcan
        </div>
    </section>

    <x-slot name="scripts">
        <x-sweetalert />
    </x-slot>
</x-authenticated-layout>
