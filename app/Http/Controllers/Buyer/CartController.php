<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())
                    ->with(['items.product', 'seller'])
                    ->get();

        return view('cart.index', compact('carts'));
    }

    public function add($productId)
    {
        $product = Product::findOrFail($productId);
        $sellerId = $product->user_id;
        $cart = Cart::where('user_id', Auth::id())->where('seller_id', $sellerId)->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'seller_id' => $sellerId,
            ]);
        }
        $cartItem = $cart->items()->where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function buyNow($productId)
    {
        $product = Product::findOrFail($productId);
        $sellerId = $product->user_id;
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'seller_id' => $sellerId,
        ]);
        $cartItem = $cart->items()
            ->where('product_id', $productId)
            ->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('checkout.index', $cart->id);
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }
        $cartItem->delete();

        return back()->with('success', 'Item removed from cart');
    }

    public function update(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);

        $type = $request->input('type');

        if ($type == 'increase') {
            $cartItem->increment('quantity');
        }

        if ($type == 'decrease') {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            }
        }

        return back();
    }
}
