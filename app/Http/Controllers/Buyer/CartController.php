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
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            $items = collect();
        } else {
            $items = $cart->items()->with('product')->get();
        }

        return view('cart.index', compact('items'));
    }

    public function add($productId)
    {
        $product = Product::find($productId);
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::user()->id,
        ]);

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
