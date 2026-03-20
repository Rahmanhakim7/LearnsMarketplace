@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto py-10 px-4">

        <h1 class="text-2xl font-bold mb-6">
            My Orders
        </h1>

        @forelse($orders as $order)
            <div class="bg-white shadow-md rounded-xl mb-6 border">
                <div class="flex justify-between items-center p-4 border-b bg-gray-50">

                    <div>
                        <p class="text-sm text-gray-500">
                            Order ID
                        </p>
                        <p class="font-semibold">
                            #{{ $order->id }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Date
                        </p>
                        <p class="font-medium">
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                </div>
                <div class="p-4 space-y-4">

                    @foreach ($order->items as $item)
                        <div class="flex items-center justify-between border-b pb-3">

                            <div class="flex items-center gap-4">

                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                    class="w-16 h-16 rounded-lg object-cover">

                                <div>

                                    <p class="font-semibold">
                                        {{ $item->product->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Qty : {{ $item->quantity }}
                                    </p>

                                </div>

                            </div>

                            <div class="font-semibold text-gray-700">

                                Rp {{ number_format($item->price * $item->quantity) }}

                            </div>

                        </div>
                    @endforeach

                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-b-xl">

                    <p class="font-semibold text-gray-600">
                        Total
                    </p>

                    <p class="text-lg font-bold text-indigo-600">
                        Rp {{ number_format($order->total_price) }}
                    </p>

                </div>

            </div>

        @empty

            <div class="bg-white p-10 text-center rounded-xl shadow">

                <p class="text-gray-500 mb-4">
                    Kamu belum memiliki pesanan
                </p>

                <a href="{{ route('shop.index') }}"
                    class="px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">

                    Belanja Sekarang

                </a>

            </div>
        @endforelse

    </div>

@endsection
