@extends('layouts.seller')
@section('seller-content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        Pesanan Masuk
    </h1>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Order ID</th>
                    <th class="px-4 py-3">Produk</th>
                    <th class="px-4 py-3">Pembeli</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($orders as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <a href="{{ route('seller.order.show', $item->order->id) }}"
                                class="text-indigo-600 hover:underline font-medium">
                                #{{ $item->id }}
                            </a>
                        </td>
                        <td class="px-4 py-3 flex items-center gap-3">
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                class="w-12 h-12 object-cover rounded">
                            <span>{{ $item->product->name }}</span>
                        </td>
                        <td class="px-4 py-3">
                            {{ $item->order->user->name ?? '-' }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-4 py-3">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 font-semibold">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-gray-500">
                            {{ $item->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                {{ $item->order->status }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-center gap-3 px-2">
                                <form action="{{ route('seller.orders.updateStatus', $item->order->id) }}" method="POST"
                                    class="flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="border rounded px-6 py-1 text-sm">
                                        <option value="pending">Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-sm">
                                        Update
                                    </button>
                                </form>
                                <a href="{{ route('seller.order.show', $item->order->id) }}"
                                    class="bg-gray-500 text-white px-3 py-1 rounded">
                                    Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">
                            Belum ada pesanan masuk
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection
