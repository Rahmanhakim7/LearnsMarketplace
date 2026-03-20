@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto py-10 px-4">

```
<h1 class="text-3xl font-bold mb-8">
    Checkout
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2">

        <div class="bg-white shadow rounded-xl p-6">

            <h2 class="text-lg font-semibold mb-4">
                Produk yang dibeli
            </h2>

            @php
                $grandTotal = 0;
            @endphp

            @foreach($cart->items as $item)

            @php
                $total = $item->product->price * $item->quantity;
                $grandTotal += $total;
            @endphp

            <div class="flex items-center justify-between border-b py-4">

                <div class="flex flex-col items-center gap-4">

                    <img src="{{ asset('storage/'.$item->product->image) }}"
                         class="w-20 h-20 object-cover rounded-lg border">

                    <div>

                        <p class="font-semibold text-gray-800">
                            {{ $item->product->name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Qty : {{ $item->quantity }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Harga : Rp {{ number_format($item->product->price) }}
                        </p>

                    </div>

                </div>
            </div>

            @endforeach

        </div>

    </div>
    <div>

        <div class="bg-white shadow rounded-xl p-6 sticky top-24">

            <h2 class="text-lg font-semibold mb-4">
                Ringkasan Belanja
            </h2>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($grandTotal) }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Ongkir</span>
                    <span class="text-green-600">Gratis</span>
                </div>

                <div class="border-t pt-3 flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span class="text-indigo-600">
                        Rp {{ number_format($grandTotal) }}
                    </span>
                </div>

            </div>

            <form method="POST" action="{{ route('checkout.store') }}" class="mt-6">
                @csrf

                <button
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">

                    Bayar Sekarang

                </button>

            </form>

        </div>

    </div>

</div>
</div>
@endsection
