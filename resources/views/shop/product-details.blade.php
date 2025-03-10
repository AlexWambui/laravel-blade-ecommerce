<x-guest-layout>
    <section class="ProductDetails">
        <div class="container">
            <div class="row_container">
                <div class="images">
                    <div class="main_product_image">
                        <img src="{{ $product->getFirstImage() ?? asset('assets/images/default_image.jpg') }}" alt="Product Image" width="300" height="300">
                    </div>

                    <div class="other_images">
                        @forelse($product->images as $image)
                            <img src="{{ $image->getProductImageURL() }}" alt="Other Image" width="150" height="150">
                        @empty
                            <p>There's no other images.</p>
                        @endforelse
                    </div>
                </div>

                <div class="details">
                    <p class="title">{{ $product->name }}</p>

                    <p class="prices">
                        @if($product->discount_price && $product->discount_price < $product->selling_price)
                            <span class="price success">Ksh. {{ number_format($product->getEffectivePrice(), 2) }}</span>
                            <span class="old_price danger"><del>{{ number_format($product->selling_price, 2) }}</del></span>
                            <span class="discount">({{ $product->calculateDiscount() }}% off)</span>
                        @else
                            <span class="price success">Ksh. {{ number_format($product->getEffectivePrice(), 2) }}</span>
                        @endif
                    </p>

                    <div class="action">
                        @if ($product->stock_count > 0)
                            <form action="{{ route('cart.store', $product->id) }}" method="post">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-cart-plus add_to_cart_btn"></i> Add to
                                    Cart
                                </button>
                            </form>
                        @else
                            <span class="danger"><b>Out of Stock</b></span>
                        @endif
                    </div>

                    <div class="extra_details">
                        @if($product->category_id != null)
                            <p>
                                <span>Category</span>
                                <span>
                                    <a href="{{ route('products.categorized', $product->category->slug) }}">
                                        {{ $product->category->name }}
                                    </a>
                                </span>
                            </p>
                        @endif
                    </div>

                    <div class="description">
                        <div id="short-description" style="transition: max-height 0.3s ease-out;">
                            {!! Illuminate\Support\Str::limit($product->description, 500) !!}
                        </div>
                        
                        <div id="full-description" style="display: none; transition: max-height 0.3s ease-in;">
                            {!! $product->description !!}
                        </div>
    
                        <button id="see-more-btn" 
                            style="display: inline-block; 
                                background: transparent; 
                                color: #1a237e; 
                                border: none; 
                                padding: 0.5em 0; 
                                margin-top: 1em; 
                                font-size: 0.9rem; 
                                font-weight: 600; 
                                cursor: pointer; 
                                transition: color 0.3s ease;"
                            onclick="toggleDescription()">
                            See More <i class="fas fa-chevron-down" style="margin-left: 0.3em; transition: transform 0.3s ease;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if($related_products->count() > 0)
            <div class="container related_products">
                <p class="title">Related Products</p>
                <div class="cards products">
                    @foreach($related_products as $product)
                        @include('partials.product-card')
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    <x-slot name="scripts">
        <script>
            function toggleDescription() {
                const shortDesc = document.getElementById('short-description');
                const fullDesc = document.getElementById('full-description');
                const button = document.getElementById('see-more-btn');
                const icon = button.querySelector('i');
                
                if (fullDesc.style.display === 'none') {
                    // Show full description
                    shortDesc.style.display = 'none';
                    fullDesc.style.display = 'block';
                    button.innerHTML = `See Less <i class="fas fa-chevron-up" style="margin-left: 0.3em;"></i>`;
                } else {
                    // Show short description
                    shortDesc.style.display = 'block';
                    fullDesc.style.display = 'none';
                    button.innerHTML = `See More <i class="fas fa-chevron-down" style="margin-left: 0.3em;"></i>`;
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const shortDesc = document.getElementById('short-description');
                const fullDesc = document.getElementById('full-description');
                const button = document.getElementById('see-more-btn');
                
                if (shortDesc.innerText.trim() === fullDesc.innerText.trim()) {
                    button.style.display = 'none';
                }
            });

            document.addEventListener("DOMContentLoaded", function () {
                // Your existing image zoom code...
                const mainProductImage = document.querySelector(".main_product_image img");
                const otherImagesContainer = document.querySelector(".other_images");
                otherImagesContainer.querySelectorAll("img").forEach((thumbnail) => {
                    thumbnail.addEventListener("click", (event) => {
                        // Remove active class from all thumbnails
                        otherImagesContainer.querySelectorAll("img").forEach((img) => {
                            img.classList.remove("active");
                        });
                        // Add active class to the clicked thumbnail
                        event.target.classList.add("active");

                        // Change the source of the main product image with a zoom effect
                        mainProductImage.src = event.target.src;
                    });
                });

                // Add the zoom effect on hover for the main product image
                mainProductImage.addEventListener("mousemove", (e) => {
                    const containerWidth = mainProductImage.offsetWidth;
                    const containerHeight = mainProductImage.offsetHeight;

                    const image = mainProductImage;
                    const imageWidth = image.offsetWidth;
                    const imageHeight = image.offsetHeight;

                    const x = e.pageX - mainProductImage.offsetLeft;
                    const y = e.pageY - mainProductImage.offsetTop;

                    const translateX = (containerWidth / 2 - x) * 2;
                    const translateY = (containerHeight / 2 - y) * 2;

                    const scale = 3;

                    image.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
                });

                mainProductImage.addEventListener("mouseleave", () => {
                    mainProductImage.style.transform = "translate(0%, 0%) scale(1)";
                });
            });
        </script>
    </x-slot>
</x-guest-layout>