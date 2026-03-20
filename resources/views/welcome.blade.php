<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyMarketplace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50">
    @include('layouts.navigation')
    <section x-data="{
        slide: 1,
        total: 3,
        start() {
            setInterval(() => {
                this.slide = this.slide === this.total ? 1 : this.slide + 1
            }, 5000)
        }
    }" x-init="start" class="relative w-full h-[550px] overflow-hidden">

        <!-- SLIDE 1 -->
        <div x-show="slide === 1" x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
            class="absolute inset-0">

            <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/40 flex items-center">
                <div class="max-w-7xl mx-auto px-6 text-white">
                    <h1 class="text-5xl font-bold mb-4">
                        Belanja Mudah & Aman
                    </h1>

                    <p class="mb-6 text-lg">
                        Temukan produk terbaik dari seller terpercaya
                    </p>

                    <a href="{{ route('shop.index') }}" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-lg">
                        Shop Now
                    </a>
                </div>
            </div>
        </div>


        <!-- SLIDE 2 -->
        <div x-show="slide === 2" x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
            class="absolute inset-0">

            <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/40 flex items-center">
                <div class="max-w-7xl mx-auto px-6 text-white">
                    <h1 class="text-5xl font-bold mb-4">
                        Diskon Hingga 50%
                    </h1>

                    <p class="mb-6 text-lg">
                        Promo spesial hanya hari ini
                    </p>

                    <a href="{{ route('shop.index') }}" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-lg">
                        Belanja Sekarang
                    </a>
                </div>
            </div>
        </div>


        <!-- SLIDE 3 -->
        <div x-show="slide === 3" x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
            class="absolute inset-0">

            <img src="https://images.unsplash.com/photo-1607083206968-13611e3d76db" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/40 flex items-center">
                <div class="max-w-7xl mx-auto px-6 text-white">
                    <h1 class="text-5xl font-bold mb-4">
                        Produk Terbaik
                    </h1>

                    <p class="mb-6 text-lg">
                        Kualitas terbaik dengan harga terbaik
                    </p>

                    <a href="{{ route('shop.index') }}" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-lg">
                        Explore Products
                    </a>
                </div>
            </div>
        </div>


        <!-- BUTTON PREV -->
        <button @click="slide = slide === 1 ? total : slide - 1"
            class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white px-4 py-2 rounded-lg shadow">

            ◀
        </button>


        <!-- BUTTON NEXT -->
        <button @click="slide = slide === total ? 1 : slide + 1"
            class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white px-4 py-2 rounded-lg shadow">

            ▶
        </button>


        <!-- DOT INDICATOR -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3">
            <div @click="slide=1" :class="slide === 1 ? 'bg-white' : 'bg-white/40'"
                class="w-3 h-3 rounded-full cursor-pointer"></div>

            <div @click="slide=2" :class="slide === 2 ? 'bg-white' : 'bg-white/40'"
                class="w-3 h-3 rounded-full cursor-pointer"></div>

            <div @click="slide=3" :class="slide === 3 ? 'bg-white' : 'bg-white/40'"
                class="w-3 h-3 rounded-full cursor-pointer"></div>
        </div>

    </section>
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-10 text-center">
                <div>
                    <h3 class="text-xl font-semibold mb-2">
                        Fast Delivery
                    </h3>
                    <p class="text-gray-500">
                        Pengiriman cepat dari seller terpercaya
                    </p>
                </div>
                <div>

                    <h3 class="text-xl font-semibold mb-2">
                        Secure Payment
                    </h3>

                    <p class="text-gray-500">
                        Pembayaran aman dan terpercaya
                    </p>

                </div>

                <div>

                    <h3 class="text-xl font-semibold mb-2">
                        Best Products
                    </h3>

                    <p class="text-gray-500">
                        Produk terbaik dengan kualitas terjamin
                    </p>

                </div>

            </div>

        </div>

    </section>
    <footer class="text-center py-8 text-gray-500">

        © {{ date('Y') }} MyMarketplace

    </footer>

</body>

</html>
