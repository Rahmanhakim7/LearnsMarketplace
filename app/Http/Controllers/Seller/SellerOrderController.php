<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    public function index()
    {
        $orders = OrderItem::with(['order', 'product'])->whereHas('product', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()->get();

        return view('seller.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed',
            'tracking_number' => $request->tracking_number,
        ]);

        $order = Order::whereHas('items.product', function ($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status berhasil diupdate');
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);

        return view('seller.orders.show', compact('order'));
    }
}
