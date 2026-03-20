@extends('layouts.admin')

@section('admin-content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <p class="text-sm text-gray-500">Users</p>
            <h3 class="text-2xl font-bold mt-2">{{ $totalUsers }}</h3>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <p class="text-sm text-gray-500">Products</p>
            <h3 class="text-2xl font-bold mt-2">{{ $totalProducts }}</h3>
        </div>

        {{-- <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Transaksi</p>
            <h3 class="text-2xl font-bold mt-2">Rp 2.500.000</h3>
        </div> --}}

    </div>
@endsection
