@extends('layouts.app')

@section('content')
<!-- Add Alpine.js if not already loaded -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div x-data="{
        activeSlide: 0,
        slides: [
            'https://s3.amazonaws.com/yomzansi.com/wp-content/uploads/2023/10/23130251/asap-rocky-formula-1-puma-.jpg',
            'https://www.rebelsport.co.nz/globalassets/2.-rebel-sport/002.-category-pages/kids/8170914_prod_lifestylebanner_1.jpg',
            'https://about.puma.com/sites/default/files/styles/dd_hero_tablet/public/media/news/images/m07-22.jpg?itok=Rjl74xLI'
        ],
        init() {
            setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            }, 2000);
        }
    }" x-init="init"
    class="relative w-full h-[200px] sm:h-[300px] md:h-[400px] lg:h-[500px] overflow-hidden rounded-lg shadow-lg">

    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index" x-transition:enter="transition-opacity duration-700"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
            <img :src="slide" alt="Slide" class="w-full h-full object-cover">
        </div>
    </template>
</div>

<div class="container mx-auto px-6 py-10">
    <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">Explore Our Shoe Collection</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        {{-- Product 1 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-gray-100 flex items-center justify-center">
                <img src="https://static.nike.com/a/images/t_default/cb1951e7-0600-4f7a-9b26-12be8cd2bd01/W+AIR+MAX+270.png"
                    alt="
                    Air Max 270" class="object-contain h-full w-full">
            </div>
            <div class="p-5">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 truncate">Air Max 270</h2>
                <p class="text-gray-700 mb-1 truncate" title="Comfortable and stylish running shoes.">Comfortable and
                    stylish running shoes.</p>
                <div class="flex items-center justify-between mt-3">
                    <div>
                        <p class="text-lg font-bold text-indigo-600">\LKR 15000.00</p>
                        <p class="text-sm line-through text-gray-400">\LKR 19000.00</p>
                    </div>
                    <div class="text-sm text-gray-600 text-right">
                        <p>Brand: Nike</p>
                        <p>Category: Running</p>
                    </div>
                </div>
                <button
                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">
                    View Details
                </button>
            </div>
        </div>

        {{-- Product 2 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-gray-100 flex items-center justify-center">
                <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/jyfsnrfrqnvo8ahvuzeg/AIR+FORCE+1+FLYKNIT+2.0.png"
                    alt="UltraBoost 21" class="object-contain h-full w-full">
            </div>
            <div class="p-5">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 truncate">Nike Air Force 1 Flyknit 2.0</h2>
                <p class="text-gray-700 mb-1 truncate" title="Responsive running shoe with great energy return.">
                    Responsive running shoe with great energy return.</p>
                <div class="flex items-center justify-between mt-3">
                    <div>
                        <p class="text-lg font-bold text-indigo-600">\LKR 18000</p>
                        <p class="text-sm line-through text-gray-400">\LKR 19000</p>
                    </div>
                    <div class="text-sm text-gray-600 text-right">
                        <p>Brand: Nike</p>
                        <p>Category: Casual</p>
                    </div>
                </div>
                <button
                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">
                    View Details
                </button>
            </div>
        </div>

        {{-- Product 3 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-gray-100 flex items-center justify-center">
                <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/556d3884-4081-4c5a-88aa-f3711c80742c/NIKE+FREE+METCON+6.png"
                    alt=" Classic Vans" class="object-contain h-full w-full">
            </div>
            <div class="p-5">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 truncate">Nike Free Metcon 6</h2>
                <p class="text-gray-700 mb-1 truncate" title="Iconic skate shoes with timeless style.">Iconic skate
                    shoes with timeless style.</p>
                <div class="flex items-center justify-between mt-3">
                    <div>
                        <p class="text-lg font-bold text-indigo-600">\LKR 60000</p>
                        <p class="text-sm line-through text-gray-400">\LKR 550000</p>
                    </div>
                    <div class="text-sm text-gray-600 text-right">
                        <p>Brand: Vans</p>
                        <p>Category: Casual</p>
                    </div>
                </div>
                <button
                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">
                    View Details
                </button>
            </div>
        </div>
        {{-- Product 4 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-gray-100 flex items-center justify-center">
                <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/8bf8448b-1595-4ad8-b872-3aaa5cc489f0/NIKE+AIR+MAX+SC.png"
                    alt=" Classic Vans" class="object-contain h-full w-full">
            </div>
            <div class="p-5">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 truncate">Nike Air Max SC</h2>
                <p class="text-gray-700 mb-1 truncate" title="Iconic skate shoes with timeless style.">Iconic skate
                    shoes with timeless style.</p>
                <div class="flex items-center justify-between mt-3">
                    <div>
                        <p class="text-lg font-bold text-indigo-600">\LKR 40000</p>
                        <p class="text-sm line-through text-gray-400">\LKR 50000</p>
                    </div>
                    <div class="text-sm text-gray-600 text-right">
                        <p>Brand: Vans</p>
                        <p>Category: Casual</p>
                    </div>
                </div>
                <button
                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">
                    View Details
                </button>
            </div>
        </div>

    </div>

</div>
@endsection