@extends('layouts.app')
@section('content')
    <div x-data="{ loading: false }" class="flex min-h-screen">
        <aside class="w-64 bg-white dark:bg-gray-800 border-r dark:border-gray-700">
            <nav class="p-4 space-y-1 text-sm">

                <a href="{{ route('admin.dashboard') }}" @click="loading = true"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg 
               {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}" @click="loading = true"
                    class="flex items-center gap-3 px-4 py-2 rounded 
               {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                    <span>Products</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" @click="loading = true"
                    class="flex items-center gap-3 px-4 py-2 rounded 
                    {{ request()->routeIs('admin.categories.*')
                     ? 'bg-indigo-600 text-white'
                    : 'text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                    <span>Categories</span>
                </a>
            </nav>
        </aside>
        <div class="flex-1 p-8 relative">
            <div x-show="loading" x-transition.opacity
                class="absolute inset-0 bg-white dark:bg-gray-900
                   flex items-center justify-center z-50">

                <div class="w-full max-w-lg space-y-4 animate-pulse">
                    <div class="h-6 bg-gray-300 dark:bg-gray-700 rounded"></div>
                    <div class="h-6 bg-gray-300 dark:bg-gray-700 rounded"></div>
                    <div class="h-6 bg-gray-300 dark:bg-gray-700 rounded"></div>
                </div>
            </div>
            <div x-data="{ show: false }" x-init="requestAnimationFrame(() => show = true)" x-show="show"
                x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0">
                @yield('admin-content')
            </div>
        </div>
    </div>
@endsection
