<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index($cartId)
    {
        $cart = Cart::with(['items.product', 'seller'])
            ->where('id', $cartId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.index', compact('cart'));
    }

    public function store()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }
        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending',
        ]);
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
        $cart->items()->delete();

        return redirect()->route('shop.index')
            ->with('success', 'Order berhasil dibuat');
    }
}
