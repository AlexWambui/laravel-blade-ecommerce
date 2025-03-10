<?php

namespace App\Http\Controllers;

use App\Models\Products\Product;
use App\Models\Products\ProductCategory;
use Illuminate\Http\Request;

class GeneralPagesController extends Controller
{
    public function home()
    {
        $featured_products = Product::with('category', 'images')->where([
            ['featured', 1],
            ['is_visible', 1],
            // ['stock_count', '>', 0]
        ])
        ->orderBy('product_order')
        ->take(12)
        ->get();

        return view('index', compact('featured_products'));
    }
    
    public function shop()
    {
        $products = Product::orderBy('name','asc')->where([
            ['is_visible', 1],
        ])->get();
        $product_categories = ProductCategory::orderBy('name','asc')->take(18)->get();
        
        return view('shop.shop', compact('products', 'product_categories'));
    }
}
