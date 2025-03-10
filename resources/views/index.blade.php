<x-guest-layout class="HomePage">
    <x-slot name="head">
        <title>Home | {{ config('globals.app_name') }}</title>
        <meta name="description" content="Home page description">
        <meta name="keywords" content="home, website, example">
    </x-slot>

    <section class="Hero">
        <div class="container">
            <div class="text">
                <p class="title">{{ config("globals.app_name") }}</h1>
                <p class="sub_title">{{ config("globals.app_slogan") }}</p>
                <div class="btns">
                    <a href="{{ route('login') }}">Start Shopping</a>
                </div>
            </div>

            <div class="image">
                <img src="{{ asset('assets/images/hero.svg') }}" alt="Hero Image" width="400px" height="400px">
            </div>
        </div>
    </section>

    <section class="About">
        <div class="container">
            <div class="steps">
                <div class="step">
                    <span class="fa fa-search"></span>
                    <p>Browse</p>
                </div>

                <div class="step">
                    <span class="fa fa-cart-plus"></span>
                    <p>Add to Cart</p>
                </div>

                <div class="step">
                    <span class="fa fa-eye"></span>
                    <p>Checkout</p>
                </div>

                <div class="step">
                    <span class="fa fa-check-circle"></span>
                    <p>Done</p>
                </div>
            </div>
        </div>
    </section>

    @if($featured_products->isNotEmpty())
        <section class="FeaturedProducts">
            <div class="container">
                <p class="title section_title">Most Popular</p>

                <div class="cards">
                    @foreach($featured_products as $product)
                        @include('partials.product-card')
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-guest-layout>
