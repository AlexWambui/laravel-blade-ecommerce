<x-guest-layout class="HomePage">
    <x-slot name="head">
        <title>Checkout | {{ config('globals.app_name') }}</title>
    </x-slot>

    <section class="Checkout">
        <div class="header">
            <h1>Billing Information</h1>
        </div>

        <div class="container">
            <div class="body">
                <div class="custom_form">
                    <form action="" method="post">
                        @csrf
    
                        <div class="input_group">
                            <div class="inputs">
                                <label for="full_name" class="required">Full Name</label>
                                <input type="text" name="full_name" id="full_name" placeholder="Jane Doe" value="{{ old('full_name', $user ? $user->full_name : '') }}">
                                <x-input-error field="full_name" />
                            </div>
        
                            <div class="inputs">
                                <label for="email" class="required">Email Address</label>
                                <input type="email" name="email" id="email" placeholder="janedoe@gmail.com" value="{{ old('email', $user ? $user->email : '') }}">
                                <x-input-error field="email" />
                            </div>
                        </div>

                        <div class="input_group">
                            <div class="inputs">
                                <label for="phone_number" class="required">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" placeholder="254746055xxx or 254146055xxx" value="{{ old('phone_number', $user ? $user->phone_number : '') }}">
                                <x-input-error field="phone_number" />
                            </div>
                        </div>
    
                        <div class="inputs">
                            <label for="pickup_method">How Would you like to receive your Order?</label>
                            <div class="custom_radio_buttons">
                                <label>
                                    <input class="option_radio" type="radio" name="pickup_method" id="shop" value="shop" {{ old('pickup_method', 'shop') == 'shop' ? 'checked' : '' }}>
                                    <span>Pick it from the shop</span>
                                </label>
    
                                <label>
                                    <input class="option_radio" type="radio" name="pickup_method" id="delivery" value="delivery" {{ old('pickup_method') == 'delivery' ? 'checked' : '' }}>
                                    <span>Delivery</span>
                                </label>
                            </div>
                            <x-input-error field="pickup_method" />
                        </div>
    
                        <div class="delivery_details input_group" id="delivery_details">
                            <div class="inputs">
                                <label for="location">Location</label>
                                <select name="location" id="location">
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location') == $location->id ? "selected" : "" }}>{{ $location->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error field="location" />
                            </div>
    
                            <div class="inputs">
                                <label for="area">Area</label>
                                <select name="area" id="area">
                                    <option value="">Select Area</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" {{ old('area') == $area->id ? "selected" : "" }}>{{ $area->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error field="area" />
                            </div>

                            <div class="inputs">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" placeholder="Enter the specific address where you'd like to receive the delivery..." value="{{ old('address') }}">
                                <x-input-error field="address" />
                            </div>
                        </div>
    

                        <button type="submit">Confirm Order</button>
                    </form>
                </div>
    
                <div class="summary">
                    <p class="title">Order Summary</p>
    
                    <p>
                        <span>Cart Total</span>
                        <span>{{ number_format($cart['subtotal'], 2) }}</span>
                    </p>
    
                    <p>
                        <span>Shipping Cost</span>
                        <span id="shipping_cost_amount">Ksh. {{ session('shipping_price', 0) }}</span>
                    </p>
    
                    <p class="total_amount">
                        <span>Total</span>
                        <span id="total_amount">Ksh. {{ number_format($cart['subtotal'] + session('shipping_price', 0), 2) }}</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const locationSelect = document.getElementById("location");
                const areaSelect = document.getElementById("area");
                const shippingCostElement = document.getElementById("shipping_cost_amount");
                const totalElement = document.getElementById("total_amount");
                const pickUpMethod = document.querySelectorAll("input[name='pickup_method']");
                const deliveryDetails = document.getElementById("delivery_details");

                function togglePickupMethod() {
                    if (pickUpMethod[1].checked) {
                        deliveryDetails.style.display = 'block';
                    } else {
                        deliveryDetails.style.display = 'none';
                    }
                }

                togglePickupMethod();
                pickUpMethod.forEach(radio => radio.addEventListener('change', togglePickupMethod));

                // Load the previously stored shipping price from Laravel session
                let areaPrice = parseFloat("{{ session('shipping_price', 0) }}");

                function updateShippingAndTotal() {
                    if (!isNaN(areaPrice)) {
                        const cartSubtotal = parseFloat("{{ $cart['subtotal'] }}");
                        shippingCostElement.textContent = `Ksh. ${areaPrice.toFixed(2)}`;
                        totalElement.textContent = `Ksh. ${(cartSubtotal + areaPrice).toFixed(2)}`;
                    }
                }

                updateShippingAndTotal(); // Ensure correct values on page load

                locationSelect.addEventListener("change", function () {
                    fetch(`/areas/fetch/${this.value}`)
                        .then(response => response.json())
                        .then(data => {
                            areaSelect.innerHTML = "";
                            areaSelect.add(new Option("Select Area", ""));

                            data.forEach(area => {
                                areaSelect.add(new Option(area.name, area.id));
                            });
                        });
                });

                areaSelect.addEventListener("change", function () {
                    fetch(`/areas/shipping-price/${this.value}`)
                        .then(response => response.json())
                        .then(data => {
                            areaPrice = data.price;
                            updateShippingAndTotal();
                        });
                });
            });
        </script>
    </x-slot>
</x-guest-layout>
