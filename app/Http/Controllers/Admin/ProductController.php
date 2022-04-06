<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        $products = Product::with('category')->latest()->get();
        return view ('admin.product.index', compact('products'));
    }

    // Add Product
    public function addProduct(){
        $categories = Category::where('parent_id', 0)->where('status', 'active')->orderBy('category_name', 'ASC')->get()->toArray();
        return view ('admin.product.add', compact('categories'));

    }
}
