<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();
        if ($request->categories) {
            $query->whereIn('category_id', $request->categories);
        }
        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        $products = $query->paginate(8)->withQueryString();
        return view('shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}
