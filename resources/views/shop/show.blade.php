@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid md:grid-cols-2 gap-10">
            <div class="bg-white rounded-xl shadow p-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-[400px] object-cover rounded-lg">
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ $product->name }}
                </h1>
                <div class="flex items-center text-yellow-400 mb-4">
                    ⭐⭐⭐⭐☆
                    <span class="text-gray-500 text-sm ml-2 drop-shadow-sm">
                        (4.5 Rating)
                    </span>
                </div>
                <div class="flex justify-between mb-3">
                    <div class="text-3xl font-bold text-indigo-600">
                        Rp {{ number_format($product->price) }}
                    </div>
                    <div class="flex align-center justify-center">
                       <span class="bg-green-500 text-white rounded p-1">Stock : {{ $product->stock }}</span>
                    </div>
                </div>
                <div class="text-gray-600 leading-relaxed text-justify mb-8">
                    {{ $product->description }}
                </div>
                <div class="flex gap-4">
                    <button class="flex-1 bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition">
                        Add to Cart
                    </button>
                    <button
                        class="flex-1 border border-indigo-600 text-indigo-600 py-3 rounded-lg hover:bg-indigo-50 transition">
                        Buy Now
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
