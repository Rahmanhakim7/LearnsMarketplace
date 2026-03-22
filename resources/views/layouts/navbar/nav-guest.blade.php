<nav class="bg-white border-b shadow-sm sticky top-0 z-50 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-xl font-bold text-indigo-600">
                MyMarketplace
            </a>
            <div class="flex items-center space-x-6">
                <a href="{{ route('shop.index') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">
                    Product
                </a>

                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">
                    Cart
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Register
                </a>
            </div>

        </div>
    </div>
</nav>
