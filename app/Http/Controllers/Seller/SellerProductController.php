<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category')->where('user_id', Auth::id())
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->search}%")
                      ->orWhere('description', 'like', "%{$request->search}%")
                      ->orWhere('price', 'like', "%{$request->search}%")
                      ->orWhere('stock', 'like', "%{$request->search}%");
                });
            });

        if ($request->categories) {
            $query->whereIn('category_id', $request->categories);
        }

        $allowedSort = ['name', 'price', 'stock', 'created_at'];
        if (in_array($request->sort, $allowedSort)) {
            $query->orderBy($request->sort, $request->direction ?? 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(5)->withQueryString();

        return view('seller.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['image'] = $imagePath;
        Product::create($validated);

        return redirect()->route('seller.products.index')->with('success', 'Produk Berhasil Di Tambahkan');
    }

    public function show(Product $product)
    {
        return view('seller.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();

        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/'.$product->image);
            }

            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('seller.products.index')
                         ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }
        $product->delete();

        return redirect()
        ->route('seller.products.index')
        ->with('success', 'Produk berhasil dihapus');
    }
}
