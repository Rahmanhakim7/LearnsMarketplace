@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">My Cart</h1>
        @if ($items->count() > 0)
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-4">Product</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Quantity</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($items as $item)
                            @php
                                $total = $item->price * $item->quantity;
                                $grandTotal += $total;
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
                                            <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200 transition">
                                                -
                                            </button>
                                        </form>
                                        <span class="px-4 py-1 text-center min-w-[40px]">
                                            {{ $item->quantity }}
                                        </span>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="type" value="increase">

                                            <button class="px-3 py-1 bg-gray-100 hover:bg-gray-200 transition">
                                                +
                                            </button>
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

                                        <button type="submit"
                                            class="text-white px-3 py-1 rounded-full bg-red-500 hover:bg-red-600">
                                            DELETE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-6">
                <a href="/"
                    class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Continue Shopping
                </a>
                <div class="flex flex-col gap-3 justify-center align-center">
                    <h2 class="text-xl font-bold">
                        Total: Rp {{ number_format($grandTotal) }}
                    </h2>
                    <a href="{{ route('checkout.index') }}">
                        <button
                            class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            Checkout
                        </button>
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white p-10 rounded shadow text-center">
                <h2 class="text-xl font-semibold mb-2">
                    Your cart is empty
                </h2>
                <p class="text-gray-500 mb-4">
                    Looks like you haven't added anything yet.
                </p>
                <a href="/" class="px-6 py-3 bg-blue-600 text-white rounded-lg">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
@endsection
