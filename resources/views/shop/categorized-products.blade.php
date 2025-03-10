<x-guest-layout class="ShopPage">
    <x-slot name="head">
        <title>Categorized Products | {{ config('globals.app_name') }}</title>
    </x-slot>

    <section class="Shop">
        <div class="container">
            <div class="header">
                <div class="breadcrumb">
                    <a href="{{ route('shop-page') }}">Shop</a>
                    <span>{{ ucfirst($category->name) }}</span>
                </div>
    
                <p class="title">{{ ucfirst($category->name) }}</p>
                <p>We have <strong>{{ $products->count() }}</strong> {{ Str::plural('product', $products->count()) }} in the <strong>{{ ucfirst($category->name) }}</strong> category.</p>
            </div>
    
            <div class="categories">
                @foreach($categories as $category)
                    <a href="{{ route('products.categorized', $category->slug) }}">{{ ucfirst($category->name) }}</a>
                @endforeach
            </div>
    
            <div class="products">
                <div class="products cards">
                    @forelse($products as $product)
                        @include('partials.product-card')
                    @empty
                        <p class="title">There's no products in this category.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>