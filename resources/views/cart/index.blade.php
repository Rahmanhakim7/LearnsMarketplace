@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">My Cart</h1>
        @forelse ($carts as $cart)
            <div class="bg-white shadow rounded-lg mb-6 overflow-hidden">
                <div class="bg-gray-100 p-4 font-semibold">
                    Toko: {{ $cart->seller->name }}
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4">Product</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Quantity</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach ($cart->items as $item)
                            @php
                                $total = $item->price * $item->quantity;
                                $subtotal += $total;
                            @endphp
                            <tr class="border-t">
                                <td class="p-4 flex items-center gap-4">
                                    <img src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}"
                                        class="w-16 h-16 object-cover rounded">
                                    <div>
                                        <h3 class="font-semibold">
                                            {{ $item->product->name }}
                                        </h3>
                                    </div>
                                </td>
                                <td class="p-4">
                                    Rp {{ number_format($item->price) }}
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center border rounded-lg w-fit overflow-hidden">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="type" value="decrease">
                                            <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200">-</button>
                                        </form>
                                        <span class="px-4">{{ $item->quantity }}</span>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="type" value="increase">
                                            <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200">+</button>
                                        </form>
                                    </div>
                                </td>

                                <td class="p-4 font-semibold">
                                    Rp {{ number_format($total) }}
                                </td>

                                <td class="p-4">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-white px-3 py-1 rounded bg-red-500 hover:bg-red-600">
                                            DELETE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right p-4 font-bold">
                    Subtotal: Rp {{ number_format($subtotal) }}
                </div>
                <div class="text-right p-4">
                    <a href="{{ route('checkout.index', $cart->id) }}">
                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Checkout
                        </button>
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white p-10 rounded shadow text-center">
                <h2 class="text-xl font-semibold mb-2">Your cart is empty</h2>
            </div>
        @endforelse
    </div>
@endsection
