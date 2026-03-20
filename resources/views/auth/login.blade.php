<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">
            Masuk ke LearnApps
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Silakan login untuk mulai belanja atau berjualan
        </p>
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center">
                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                    Lupa Password?
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-3 rounded-lg">
                Masuk
            </x-primary-button>
        </div>

    </form>

    <div class="mt-6 text-center text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">
            Daftar sekarang
        </a>
    </div>

</x-guest-layout>
