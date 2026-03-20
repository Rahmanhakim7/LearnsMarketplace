@extends('layouts.seller')

@section('seller-content')
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>
        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 flex flex-col justify-center items-center gap-2">
                <img id="preview" class="w-32 h-32 object-cover rounded-full border hidden">
                <label class="cursor-pointer bg-indigo-600 text-white px-3 py-1 rounded-lg inline-block">
                    Pilih Gambar
                    <input type="file" name="image" class="hidden">
                </label>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama Produk</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Harga</label>
                <input type="number" name="price" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Stok</label>
                <input type="number" name="stock" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="" class="block text-sm font-medium mb-1" required>Kategori</label>
                <select name="category_id" class="w-full border rounded p-2">
                    <option value="" selected>-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded p-2" rows="4"></textarea>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Simpan Produk
            </button>
        </form>
        <script>
            const inputImage = document.querySelector('input[name="image"]');
            const preview = document.getElementById('preview');
            inputImage.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </div>
@endsection
