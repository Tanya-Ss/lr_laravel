<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'material'])
            ->filter(request(['search', 'category', 'material']))
            ->paginate(12);

        $categories = Category::all();
        $materials = Material::all();

        return view('products.index', compact('products', 'categories', 'materials'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'material', 'reviews']);
        return view('products.show', compact('product'));
    }
}