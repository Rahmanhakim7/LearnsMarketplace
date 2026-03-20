<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">
            Buat Akun LearnApps
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Daftar sekarang dan mulai jual atau beli produk favoritmu
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" enctype="multipart/form-data">
        @csrf
        <div class="text-center">
            <div class="mt-3 flex justify-center">
                <img id="preview-image" src="https://ui-avatars.com/api/?name={{ old('name', 'User') }}"
                    class="w-24 h-24 rounded-full object-cover border shadow">
            </div>
            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden">
            <label for="profile_photo"
                class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg cursor-pointer hover:bg-indigo-700 transition">
                Upload Foto
            </label>
            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="role" :value="__('Role')" />

            <select name="role" id="role"
                class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
                <option value="admin">Admin</option>

            </select>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-3 rounded-lg">
                Daftar Sekarang
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center text-sm text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">
            Masuk di sini
        </a>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const input = document.getElementById('profile_photo');
            const preview = document.getElementById('preview-image');

            input.addEventListener('change', function(event) {

                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(file);
            });

        });
    </script>
</x-guest-layout>
