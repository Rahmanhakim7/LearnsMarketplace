@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white shadow rounded-xl p-6">
            <h2 class="text-xl font-bold mb-6">
                Edit Profile
            </h2>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="text-center mb-6">
                    <img id="preview-image"
                        src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                        class="w-28 h-28 rounded-full object-cover border mx-auto shadow">
                    <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="hidden">
                    <label for="profile_photo"
                        class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg cursor-pointer hover:bg-indigo-700 transition">
                        Ganti Foto
                    </label>
                    @error('profile_photo')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Nama
                    </label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('profile_photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            }
            reader.readAsDataURL(file);
        });
    </script>
@endsection
