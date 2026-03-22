<nav class="bg-white border-b shadow-sm sticky top-0 z-50 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-xl font-bold text-indigo-600">
                Admin Panel
            </a>
            <div class="flex items-center space-x-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="text-gray-700 hover:text-indigo-600 font-medium transition">
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="text-gray-700 hover:text-indigo-600 font-medium transition">
                    Users
                </a>

                <a href="{{ route('admin.products.index') }}"
                    class="text-gray-700 hover:text-indigo-600 font-medium transition">
                    Products
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <details class="group">
                        <summary
                            class="list-none cursor-pointer flex items-center gap-2 font-medium text-gray-700 hover:text-indigo-600">

                            <img src="{{ Auth::user()->profile_photo
                                ? asset('storage/' . Auth::user()->profile_photo)
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                class="w-8 h-8 rounded-full border">

                            {{ Auth::user()->name }}

                        </summary>

                        <div class="absolute right-0 mt-3 w-52 bg-white border rounded-lg shadow">

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Profile
                            </a>

                            <div class="border-t"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
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
