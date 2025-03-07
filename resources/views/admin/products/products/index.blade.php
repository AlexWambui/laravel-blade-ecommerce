<x-authenticated-layout>
    <x-slot name="head">
        <title>Products</title>
    </x-slot>

    <section class="Products">
        <div class="system_nav">
            <a href="{{ route('product-categories.index') }}">Categories</a>
            <span>Products</span>
        </div>
        
        <div class="body">
            @if ($products->isNotEmpty())
                <div class="table list_items">
                    <div class="header">
                        <div class="details">
                            <p class="title">Products</p>
                            <p class="stats">
                                <span>{{ $count_products }} {{ Str::plural('Product', $count_products) }}</span>
                            </p>
                        </div>
    
                        <x-search-input />

                        <div class="btn">
                            <a href="{{ route('products.create') }}">New Product</a>
                        </div>
                    </div>
    
                    <div class="cards">
                        @foreach($products as $product)
                            <div class="card searchable">
                                <div class="image">
                                    <a href="{{ route('products.edit', $product->id) }}">
                                        <img src="{{ $product->getFirstImage() ?? Vite::asset('resources/images/default_image.jpg') }}" alt="Product Image" width="300" height="300">
                                    </a>
                                </div>

                                <div class="text">
                                    <div class="extra_details">

                                    </div>

                                    <div class="details">
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <p class="title">{{ $product->name }}</p>
                                        </a>

                                        <p class="price">
                                            @if($product->discount_price != 0.00 && $product->discount_price < $product->selling_price)
                                                <span class="new_price">Ksh. {{ $product->discount_price }}</span>
                                                <span class="old_price"><del>{{ $product->selling_price }}</del></span>
                                            @else
                                                <span class="new_price">Ksh. {{ $product->selling_price }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p>No products yet.</p>
                <a href="{{ route('products.create') }}">Add New</a>
            @endif
        </div>
    </section>

    <x-slot name="scripts">
        <x-search />
    </x-slot>
</x-authenticated-layout>
