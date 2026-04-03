@extends('layouts.seller')
@section('seller-content')
    <div class="p-6 max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                Order Detail #{{ $order->id }}
            </h1>
            <a href="{{ route('seller.orders') }}"
                class="inline-flex items-center gap-2 bg-red-500 hover:bg-gray-200 text-white px-4 py-2 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2 space-y-6">
                <div class="bg-white shadow rounded-lg p-5">
                    <h2 class="font-semibold text-lg mb-4">Produk</h2>
                    @foreach ($order->items as $item)
                        <div class="flex items-center gap-4 border-b py-4">
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                class="w-16 h-16 object-cover rounded">
                            <div class="flex-1">
                                <h3 class="font-medium">
                                    {{ $item->product->name }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Qty: {{ $item->quantity }}
                                </p>
                            </div>
                            <div class="font-semibold">
                                Rp {{ number_format($item->price) }}
                            </div>
                        </div>
                    @endforeach
                    <div class="text-right mt-4 text-lg font-bold">
                        Total: Rp {{ number_format($order->total_price) }}
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <div class="bg-white shadow rounded-lg p-5">
                    <h2 class="font-semibold mb-2">Pembeli</h2>
                    <p class="font-medium">{{ $order->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-5">
                    <h2 class="font-semibold mb-3">Update Status</h2>
                    <form action="{{ route('seller.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="w-full border rounded p-2 mb-3">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <input type="text" name="tracking_number" placeholder="Nomor Resi"
                            value="{{ $order->tracking_number }}" class="w-full border rounded p-2 mb-3">
                        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
