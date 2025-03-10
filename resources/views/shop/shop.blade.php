<x-guest-layout class="ShopPage">
    <x-slot name="head">
        <title>Shop | {{ config('globals.app_name') }}</title>
        <meta name="description" content="Shop page description">
        <meta name="keywords" content="home, website, shop">
    </x-slot>

    <section class="Shop">
        <div class="container">
            <div class="header">
                <div class="search">
                    <x-search-input />
                </div>
            </div>

            <div class="categories">
                @forelse ($product_categories as $category)
                    <a href="{{ route('products.categorized', $category->slug) }}">{{ ucfirst($category->name) }}</a>
                @empty
                    <p class="title">There's no available product categories.</p>
                @endforelse
            </div>

            <div class="products cards">
                @forelse($products as $product)
                    @include('partials.product-card')
                @empty
                    <p class="title">There's no available products.</p>
                @endforelse
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <x-search />
    </x-slot>
</x-guest-layout>
