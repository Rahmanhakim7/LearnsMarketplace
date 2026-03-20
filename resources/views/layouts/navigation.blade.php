<nav class="bg-white border-b shadow-sm sticky top-0 z-50 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-xl font-bold text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l9 4 9-4" />
                </svg>
                MyMarketplace
            </a>
            <div class="flex items-center space-x-6">
                @guest
                    <a href="{{ route('shop.index') }}"
                        class="flex items-center gap-1 text-gray-700 hover:text-indigo-600 font-medium transition">
                        Product
                    </a>
                    <a href="{{ route('login') }}"
                        class="flex items-center gap-1 text-gray-700 hover:text-indigo-600 font-medium transition">
                        Cart
                    </a>
                @endguest
                @auth
                    @if (Auth::user()->role === 'buyer')
                        <a href="{{ route('shop.index') }}"
                            class="text-gray-700 hover:text-indigo-600 font-medium transition">
                            Product
                        </a>
                        <a href="{{ route('cart.index') }}"
                            class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 font-medium transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6
                                                    8L5.4 5M7 13l-1.35 2.7A1 1 0
                                                    007 17h10m0 0a1 1 0 110 2
                                                    1 1 0 010-2zm-10 0a1 1 0
                                                    110 2 1 1 0 010-2z" />
                            </svg>
                            Cart
                        </a>
                    @endif
                @endauth
            </div>
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Register
                    </a>
                @endguest
                @auth
                    <div class="relative">
                        <details class="group">
                            <summary
                                class="list-none cursor-pointer flex items-center gap-2 font-medium text-gray-700 hover:text-indigo-600 transition">
                                <img src="{{ Auth::user()->profile_photo
                                    ? asset('storage/' . Auth::user()->profile_photo)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                    class="w-8 h-8 rounded-full object-cover border">
                                {{ Auth::user()->name }}
                                <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div
                                class="absolute right-0 mt-3 w-52 bg-white border rounded-lg shadow-lg z-50 overflow-hidden">
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.364 4.56
                        9 9 0 015.12 17.804z" />

                                    </svg>

                                    Profile
                                </a>
                                @if (Auth::user()->role === 'buyer')
                                    <a href="{{ route('orders.index') }}"
                                    class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7h18M3 12h18M3 17h18" />

                                    </svg>
                                    My Orders
                                    </a>
                                @endif
                                <div class="border-t"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4
                            4H7m6 4v1a3 3 0 01-3
                            3H6a3 3 0 01-3-3V7a3
                            3 0 013-3h4a3 3 0
                            013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </details>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
