# Features
dashboard
messages
users
products, product_categories, product_ratings
sales
locations
blogs


# DB Design
product_categories {
    $table->id();
    $table->string('name')->unique();
}

products {
    $table->id();
    $table->string('name')->unique();
    $table->unsignedSmallInteger('product_code')->default(0);
    $table->boolean('featured')->default(0);
    $table->boolean('is_visible')->default(1);
    $table->decimal('buying_price', 10, 2)->default(0.00);
    $table->decimal('selling_price', 10, 2)->default(0.00);
    $table->decimal('discount_price', 10, 2)->default(0.00)->nullable();
    $table->unsignedSmallInteger('product_measurement')->nullable();
    $table->unsignedSmallInteger('product_order')->default(200);
    $table->unsignedSmallInteger('stock_count')->default(1);
    $table->unsignedSmallInteger('safety_stock')->default(1);
    $table->text('description')->nullable();

    $table->foreignId('category_id')->nullable()->constrained('product_categories')->nullOnDelete();
    $table->timestamps();
}

product_images {
    $table->id();
    $table->string('image');
    $table->smallInteger('image_order')->default(5);

    $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
    $table->timestamps();
}

delivery_locations {
    $table->id();
    $table->string('name')->unique();
    $table->timestamps();
}

delivery_areas {
    $table->id();
    $table->string('name')->unique();
    $table->decimal('price', 10, 2)->default(0.00);

    $table->foreignId('delivery_location_id')->constrained('delivery_locations')->cascadeOnDelete();
    $table->timestamps();
}

sales {
    $table->id();
    $table->string('order_number');
    $table->unsignedTinyInteger('order_type')->default(0);
    $table->string('discount_code')->nullable();
    $table->decimal('discount',10,2)->default(0.00);
    $table->decimal('total_amount', 10,2)->default(0.00);
    $table->decimal('amount_paid', 10,2)->default(0.00);
    $table->string('payment_method')->nullable();

    $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamps();
}

sales_items {
    $table->id();
    $table->string('name');
    $table->unsignedSmallInteger('quantity')->default(1);
    $table->decimal('buying_price',10,2)->default(0);
    $table->decimal('selling_price',10,2)->default(0);

    $table->foreignId('order_id')->constrained('sales')->onDelete('cascade');
    $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
    $table->timestamps();
}

sales_deliveries {
    $table->id();
    $table->string('full_name');
    $table->string('email');
    $table->string('phone_number');
    $table->string('address');
    $table->string('location');
    $table->string('area');
    $table->decimal('shipping_cost');
    $table->string('delivery_status')->default('pending');

    $table->foreignId('order_id')->constrained('sales')->cascadeOnDelete();
    $table->timestamps();
}
