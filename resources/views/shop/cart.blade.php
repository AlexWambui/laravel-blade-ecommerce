<x-guest-layout class="HomePage">
    <x-slot name="head">
        <title>Cart | {{ config('globals.app_name') }}</title>
    </x-slot>

    <div class="Cart">
        <div class="header">
            <h1>Your Cart</h1>
            <p>You have <b>{{ Session::get('cart_count', 0) }}</b> {{ Str::plural('item', Session::get('cart_count')) }} in your cart</p>
        </div>

        <div class="container">
            <div class="body">
                <ul>
                    @foreach($cart['items'] as $product)
                        <li>
                            <span class="title">{{ $product['name'] }}</span>
                            
                            <span class="price">
                                <span class="currency">Ksh. </span>
                                <span class="price_amount">{{ $product['selling_price'] }}</span>
                            </span>
    
                            <span class="product_quantity">
                                <form class="quantity_form" action="{{ route('cart.update', $product['id']) }}" method="post">
                                    @csrf
                                    <input type="number" name="quantity" class="quantity_input" min="1" value="{{ $product['quantity'] }}" onchange="this.form.submit()">
                                </form>
                            </span>
    
                            <span class="subtotal">
                                <span class="currency">Ksh. </span>
                                <span class="subtotal_amount">{{ $product['quantity'] * $product['selling_price'] }}</span>
                            </span>
    
                            <span class="delete_from_cart">
                                <form id="deleteForm_{{ $product['id'] }}" action="{{ route('cart.destroy', $product['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
    
                                    <button type="button" onclick="deleteItem({{ $product['id'] }}, 'product');">
                                        <i class="fas fa-trash-alt danger"></i>
                                    </button>
                                </form>
                            </span>
                        </li>
                    @endforeach
                </ul>

                <div class="summary">
                    <p class="title">Order Summary</p>
                    
                    <p>
                        <span>Cart Total</span>
                        <span id="cart_total">Ksh. {{ $cart['subtotal'] }}</span>
                    </p>

                    @if(Session::get('cart_count') > 0)
                        <div class="">
                            <a href="{{ route('checkout.create') }}">Proceed to Checkout</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <x-sweetalert />
    </x-slot>
</x-guest-layout>
