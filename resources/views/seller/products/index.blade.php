@extends('layouts.seller')

@section('seller-content')
    <div class="flex justify-end py-2 px-4 w-full">
        <form method="GET" action="{{ route('seller.products.index') }}" class="flex gap-2 justify-end w-1/2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Produk ....."
                class="border rounded-lg px-3 py-2 w-full">
            <button type="submit" class="bg-indigo-600 text-white px-4 rounded-lg">
                Search
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
        <div class="flex justify-between items-center px-3 py-3">
            <h1 class="text-2xl font-bold">Products</h1>
            <a href="{{ route('seller.products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
                + Add Product
            </a>
        </div>
        <div class="flex gap-2">
            <div class="flex w-1/4 p-4">
                <div class="bg-white dark:bg-gray-700 shadow rounded-xl p-4 w-full">
                    <h2 class="font-bold text-lg mb-2 text-center">Pilih Kategori</h2>
                    <hr class="mb-3">
                    <form method="GET" action="{{ route('seller.products.index') }}">
                        <div class="flex flex-col gap-2">
                            @foreach ($categories as $category)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        {{ in_array($category->id, request()->get('categories', [])) ? 'checked' : '' }}>
                                    {{ $category->name }}
                                </label>
                            @endforeach
                        </div>
                        <button type="submit" class="mt-3 w-full bg-indigo-600 text-white py-2 rounded-lg">
                            Filter
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex flex-col w-3/4">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-3 text-left">Image</th>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Kategori</th>
                            <th class="p-3 text-left">
                                @php
                                    $isPriceSort = request('sort') === 'price';
                                    $direction = $isPriceSort && request('direction') === 'asc' ? 'desc' : 'asc';
                                @endphp

                                <a href="{{ route(
                                    'seller.products.index',
                                    array_merge(request()->all(), [
                                        'sort' => 'price',
                                        'direction' => $direction,
                                    ]),
                                ) }}"
                                    class="flex items-center gap-1">

                                    Harga

                                    @if ($isPriceSort)
                                        @if (request('direction') === 'asc')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 15l7-7 7 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="p-3 text-left">@php
                                $isPriceSort = request('sort') === 'stock';
                                $direction = $isPriceSort && request('direction') === 'asc' ? 'desc' : 'asc';
                            @endphp

                                <a href="{{ route(
                                    'seller.products.index',
                                    array_merge(request()->all(), [
                                        'sort' => 'stock',
                                        'direction' => $direction,
                                    ]),
                                ) }}"
                                    class="flex items-center gap-1">

                                    Stock

                                    @if ($isPriceSort)
                                        @if (request('direction') === 'asc')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 15l7-7 7 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="border-t">
                                <td class="p-3">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-16 h-16 object-cover rounded-lg border">
                                    @else
                                        <div
                                            class="w-16 h-16 flex items-center justify-center bg-gray-200 rounded-lg text-xs text-gray-500">
                                            No Image
                                        </div>
                                    @endif
                                </td>
                                <td class="p-3">{{ $product->name }}</td>
                                <td class="p-3">{{ $product->category->name ?? '-' }}</td>
                                <td class="p-3">Rp {{ number_format($product->price) }}</td>
                                <td class="p-3">{{ $product->stock }}</td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('seller.products.show', $product->id) }}"
                                            class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                                            Detail
                                        </a>
                                        <a href="{{ route('seller.products.edit', $product->id) }}"
                                            class="bg-green-500 text-white px-3 py-1 rounded text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-500">
                                    No products found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
