@extends('layouts.seller')

@section('seller-content')
    <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-10">
        <div class="grid md:grid-cols-2 py-3 gap-12">
            <div class="flex justify-center px-4">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        class="h-[450px] object-cover rounded-2xl shadow-md">
                @else
                    <div class="h-[450px] flex items-center justify-center bg-gray-200 rounded-2xl">
                        No Image
                    </div>
                @endif
            </div>
            <div class="flex flex-col justify-between">
                <div class="flex flex-col gap-4 px-2">
                    <h1 class="text-3xl font-bold">
                        {{ $product->name }}
                    </h1>
                    <p class="text-2xl font-semibold text-indigo-600">
                        Rp {{ number_format($product->price) }}
                    </p>
                    <span
                        class="w-fit py-1 text-sm rounded-full p-3
                    {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Stok Habis' }}
                    </span>
                    <div class="flex flex-col">
                        <h3 class="font-semibold mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-60 leading-relaxed text-justify">
                            {{ $product->description ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-4 mt-8">
                    <a href="{{ route('seller.products.edit', $product->id) }}"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Edit
                    </a>
                    <a href="{{ route('seller.products.index') }}"
                        class="bg-gray-300 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
