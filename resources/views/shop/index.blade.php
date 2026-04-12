@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">
                🛍️ Explore Products
            </h1>
            <form method="GET" action="{{ route('shop.index') }}" class="flex w-full md:w-1/2 gap-2">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                    class="w-full border border-gray-300 rounded-full px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none shadow-sm">
                <button type="submit" class="bg-indigo-600 text-white px-5 rounded-full hover:bg-indigo-700 transition">
                    Search
                </button>
            </form>
        </div>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/4">
                <div class="bg-white shadow-lg rounded-2xl p-5 sticky top-24">
                    <h2 class="font-semibold text-lg mb-3 text-gray-700">
                        🎯 Filter Kategori
                    </h2>
                    <form method="GET" action="{{ route('shop.index') }}">
                        <div class="flex flex-col gap-2 max-h-64 overflow-y-auto">
                            @foreach ($categories as $category)
                                <label class="flex items-center gap-2 text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        class="rounded text-indigo-600 focus:ring-indigo-500"
                                        {{ in_array($category->id, request()->get('categories', [])) ? 'checked' : '' }}>
                                    {{ $category->name }}
                                </label>
                            @endforeach
                        </div>
                        <button type="submit"
                            class="mt-4 w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                            Terapkan Filter
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        @php
                            $colors = ['bg-indigo-500', 'bg-pink-500', 'bg-green-500', 'bg-yellow-500'];
                            $color = $colors[crc32($product->category->name) % count($colors)];

                            $avgRating = $product->reviews->avg('rating');
                        @endphp
                        <div
                            class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 group overflow-hidden">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-full h-44 object-cover group-hover:scale-110 transition duration-500">
                                <span
                                    class="absolute top-2 left-2 {{ $color }} text-white text-xs px-3 py-1 rounded-full shadow">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h2 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-2">
                                    {{ $product->name }}
                                </h2>
                                <div class="flex items-center text-yellow-400 text-sm mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span>{{ $i <= round($avgRating) ? '★' : '☆' }}</span>
                                    @endfor
                                    <span class="text-gray-400 text-xs ml-2">
                                        ({{ number_format($avgRating, 1) ?? 0 }})
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mb-3">
                                    {{ \Illuminate\Support\Str::limit($product->description, 40) }}
                                </p>
                                <div class="mb-3">
                                    <span class="text-indigo-600 font-bold text-lg">
                                        Rp {{ number_format($product->price) }}
                                    </span>
                                    <div class="text-xs text-gray-400 line-through">
                                        Rp {{ number_format($product->price + 50000) }}
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('shop.show', $product->id) }}"
                                        class="flex-1 text-center border border-indigo-500 text-indigo-600 py-2 rounded-lg hover:bg-indigo-50 text-sm transition">
                                        Detail
                                    </a>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 text-sm transition">
                                            + Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
