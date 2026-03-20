@extends('layouts.app')
@section('content')
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r">
            <nav class="p-4 space-y-1 text-sm">
                <a href="{{ route('buyer.dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100">
                    Dashboard
                </a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-100">
                    Pesanan Saya
                </a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-100">
                    Profile
                </a>
            </nav>
        </aside>
        <div class="flex-1 p-8">
            @yield('buyer-content')
        </div>
    </div>
@endsection
