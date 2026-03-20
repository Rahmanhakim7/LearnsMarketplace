@extends('layouts.admin')

@section('admin-content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Categories</h1>

        <a href="{{ route('admin.categories.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
            + Add Category
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                <tr>
                    <th class="p-4">No</th>
                    <th class="p-4">Name</th>
                    <th class="p-4">Slug</th>
                    <th class="p-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-gray-700">
                @forelse($categories as $index => $category)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="p-4">{{ $index + 1 }}</td>
                        <td class="p-4 font-medium">{{ $category->name }}</td>
                        <td class="p-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="p-4 text-center flex justify-center gap-2">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="px-3 py-1 bg-green-500 hover:bg-red-700 text-white rounded">
                                    Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            No categories yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t dark:border-gray-700 flex justify-end">
            {{ $categories->withQueryString()->links() }}
        </div>
    </div>
@endsection
