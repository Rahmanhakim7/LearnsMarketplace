<nav class="bg-white border-b shadow-sm sticky top-0 z-50 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ url('/seller/dashboard') }}" class="flex items-center gap-2 text-xl font-bold text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l9 4 9-4" />
                </svg>
                MyMarketplace
            </a>
            <div class="flex items-center space-x-4">
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
                                Profile
                            </a>
                            <div class="border-t"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 transition">
                                    Logout
                                </button>
                            </form>

                        </div>
                    </details>
                </div>
            </div>

        </div>
    </div>
</nav>
