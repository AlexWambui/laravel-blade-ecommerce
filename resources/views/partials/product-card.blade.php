<div class="card searchable">
    <div class="image">
        <a href="{{ route('products.details', $product->slug) }}">
            <img src="{{ $product->getFirstImage() ?? asset('assets/images/default_image.jpg') }}" alt="Product Image" width="300" height="300">
        </a>
    </div>

    <div class="text">
        <div class="extra_details">
            @if($product->category_id != null)
                <span>
                    <a href="{{ route('products.categorized', $product->category->slug) }}">{{ $product->category->name }}</a>
                </span>
            @endif
            @if($product->stock_count <= 0)
                <span class="title danger">out of stock</span>
            @endif
        </div>

        <div class="details row">
            <div class="column">
                <a href="{{ route('products.details', $product->slug) }}">
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

            @if($product->stock_count != 0)
                <div class="cart">
                    <form action="{{ route('cart.store', $product->id) }}" method="post">
                        @csrf

                        <button><span class="fa fa-cart-plus"></span></button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>