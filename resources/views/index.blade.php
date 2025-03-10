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
                        <div class="card searchable">
                            <div class="image">
                                <a href="{{ route('products.edit', $product->id) }}">
                                    <img src="{{ $product->getFirstImage() ?? asset('assets/images/default_image.jpg') }}" alt="Product Image" width="300" height="300">
                                </a>
                            </div>

                            <div class="text">
                                <div class="extra_details">
                                    @if($product->stock_count <= 0)
                                        <span class="title danger">out of stock</span>
                                    @endif
                                </div>

                                <div class="details row">
                                    <div class="column">
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <p class="title">{{ $product->name }}</p>
                                        </a>
    
                                        <p class="prices">
                                            @if($product->discount_price && $product->discount_price < $product->selling_price)
                                                <span class="price success">Ksh. {{ number_format($product->getEffectivePrice(), 2) }}</span>
                                                <span class="old_price danger"><del>{{ number_format($product->selling_price, 2) }}</del></span>
                                                <span class="discount">({{ $product->calculateDiscount() }}% off)</span>
                                            @else
                                                <span class="price success">Ksh. {{ number_format($product->getEffectivePrice(), 2) }}</span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="cart">
                                        <form action="{{ route('cart.store', $product->id) }}" method="post">
                                            @csrf

                                            <button><span class="fa fa-cart-plus"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-guest-layout>
