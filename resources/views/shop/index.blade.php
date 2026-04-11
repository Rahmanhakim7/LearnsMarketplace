  @extends('layouts.app')
  @section('content')
      <div class="max-w-7xl mx-auto px-4 py-10">
          <h1 class="px-3 text-3xl font-bold mb-6 text-gray-800">
              Products
          </h1>
          <form method="GET" action="{{ route('shop.index') }}" class="flex gap-3 px-3 mb-6">
              <input type="text" name="search" placeholder="Search product..." value="{{ request('search') }}"
                  class="w-full md:w-1/2 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
              <button type="submit"
                  class="w-1/4 bg-indigo-600 text-white py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-lg">
                  Submit
              </button>
          </form>
          <div class="flex gap-2 justify-between">
              <div class="flex w-1/4 px-3">
                  <div class="bg-white dark:bg-gray-700 shadow rounded-xl p-4 w-full h-fit">
                      <h2 class="font-bold text-lg mb-2 text-center">Pilih Kategori</h2>
                      <hr class="mb-3">
                      <form method="GET" action="{{ route('shop.index') }}">
                          <div class="flex flex-col gap-2">
                              @foreach ($categories as $category)
                                  <label class="flex items-center gap-2">
                                      <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                          {{ in_array($category->id, request()->get('categories', [])) ? 'checked' : '' }}>
                                      {{ $category->name }}
                                  </label>
                              @endforeach
                          </div>
                          <button type="submit" class="mt-3 w-full bg-indigo-600 text-white py-2 rounded-lg">
                              Filter
                          </button>
                      </form>
                  </div>
              </div>
              <div class="flex flex-col gap-4">
                  <div class="grid grid-cols-4 gap-4">
                      @foreach ($products as $product)
                          @php
                              $colors = [
                                  'bg-red-500',
                                  'bg-blue-500',
                                  'bg-green-500',
                                  'bg-yellow-500',
                                  'bg-purple-500',
                                  'bg-pink-500',
                                  'bg-indigo-500',
                                  'bg-orange-500',
                                  'bg-teal-500',
                              ];
                              $color = $colors[crc32($product->category->name) % count($colors)];
                          @endphp
                          <div
                              class=" bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group">
                              <div class="relative overflow-hidden">
                                  <img src="{{ asset('storage/' . $product->image) }}"
                                      class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                              </div>
                              <div class="p-4">
                                  <div class="flex justify-between">
                                      <h2 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-2">
                                          {{ $product->name }}
                                      </h2>
                                      <span
                                          class="{{ $color }} text-white text-xs rounded-full py-1 px-3 whitespace-nowrap">
                                          {{ $product->category->name }}
                                      </span>
                                  </div>
                                  @php
                                      $avgRating = $product->reviews->avg('rating');
                                      $totalReview = $product->reviews->count();
                                  @endphp
                                  <div class="flex items-center text-yellow-400 text-sm mb-2">
                                      @for ($i = 1; $i <= 5; $i++)
                                          <span>
                                              {{ $i <= round($avgRating) ? '★' : '☆' }}
                                          </span>
                                      @endfor
                                      <span class="text-gray-500 text-xs ml-2">
                                          ({{ number_format($avgRating, 1) ?? 0 }})
                                      </span>
                                  </div>
                                  <p class="text-xs text-gray-500 mb-3">
                                      {{ \Illuminate\Support\Str::limit($product->description, 30) }}
                                  </p>
                                  <div class="flex items-center justify-between mb-3">
                                      <span class="text-indigo-600 font-bold text-lg">
                                          Rp {{ number_format($product->price) }}
                                      </span>
                                      <span class="text-xs text-gray-400 line-through">
                                          Rp {{ number_format($product->price + 50000) }}
                                      </span>
                                  </div>
                                  <div class="flex gap-2">
                                      <a href="{{ route('shop.show', $product->id) }}"
                                          class="flex-1 text-center border border-indigo-600 text-indigo-600 py-2 rounded-lg hover:bg-indigo-50 text-sm">
                                          Detail
                                      </a>
                                      <form action="{{ route('cart.add', $product->id) }}" method="POST"
                                          class="flex-1 bg-indigo-600 text-white text-center py-2 rounded-lg hover:bg-indigo-700 text-sm">
                                          @csrf
                                          <button type="submit">Add To Cart</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
                  <div class="mt-10">
                      {{ $products->links() }}
                  </div>
              </div>
          </div>

      </div>
  @endsection
