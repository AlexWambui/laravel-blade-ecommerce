<x-guest-layout>
    <x-slot name="head">
        <title>Successful Order</title>
    </slot>

    <section class="CheckoutSuccess">
        <div class="container">
            <div class="success_animation">
                <i class="fa fa-check-circle success"></i>
            </div>

            <p class="title">Success</p>

            <p>Your order (<strong>{{ $order_number }}</strong>) has been submitted.</p>
            
            <p>We will contact you in case we need any clarification.</p>

            <div class="actions">
                <a href="{{ route('shop-page') }}">Continue Shopping</a>
            </div>
        </div>
    </section>
</x-guest-layout>