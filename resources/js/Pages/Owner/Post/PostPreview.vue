<script setup>
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    post: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <Head :title="`Preview - ${post.title}`"/>

    <div>

        <div class="max-w-6xl mx-auto py-10 px-4">
            <!-- Title and Category -->
            <div class="flex items-center gap-4 mb-6">
                <img :src="`/storage/${post.category.icon_path}`" alt="category icon" class="w-10 h-10 object-contain" />
                <h1 class="text-3xl font-bold capitalize">{{ post.title }}</h1>
            </div>

            <!-- Image Carousel -->
            <Splide :options="{ type: 'loop', perPage: 1, autoplay: true }" class="mb-6 rounded-xl overflow-hidden">
                <SplideSlide v-for="img in post.images" :key="img.id">
                    <img :src="`/storage/${img.image_path}`" class="w-full h-96 object-cover" />
                </SplideSlide>
            </Splide>

            <!-- Description -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-2">Description</h2>
                <p class="text-gray-700 whitespace-pre-line leading-relaxed">
                    {{ post.description }}
                </p>
            </div>

            <!-- Amenities -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Amenities</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <div
                        v-for="amenity in post.amenities"
                        :key="amenity.id"
                        class="flex items-center gap-3 p-4 bg-gray-50 border rounded-lg shadow-sm"
                    >
                        <img :src="`/storage/${amenity.icon_path}`" class="w-8 h-8 object-contain" />
                        <span class="capitalize text-gray-800">{{ amenity.name }}</span>
                    </div>
                </div>
            </div>

            <!-- Price and Booking Info -->
            <div class="flex flex-col sm:flex-row justify-between items-center border-t pt-6">
                <div class="mb-4 sm:mb-0">
                    <p class="text-lg font-semibold">Price</p>
                    <p class="text-2xl text-blue-600 font-bold">{{ $formatRupiah(post.price) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Available: {{ post.quantity_left }} / {{ post.quantity }}</p>
                    <a href="#"
                       class="cursor-pointer btn bg-blue-600 text-white px-6 rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
