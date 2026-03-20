@extends('layouts.admin')

@section('admin-content')
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-6">Add Category</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block mb-2 font-medium">Category Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Electronics"
                    class="w-full border rounded-lg p-3 focus:ring focus:ring-indigo-200" required>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg">
                    Cancel
                </a>

                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
                    Save Category
                </button>
            </div>
        </form>
    </div>
@endsection
