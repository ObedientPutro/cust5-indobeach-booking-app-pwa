<script setup>
import { Link } from '@inertiajs/vue3';
import ImageCarousel from "@/Components/ImageCarousel.vue";

defineProps({
    post: Object,
});

const formatRupiah = (amount) => {
    if (!amount) return "Rp 0";
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
};
</script>

<template>
    <div class="group flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
        <div class="aspect-1 relative overflow-hidden">
            <ImageCarousel v-if="post.images && post.images.length > 0" :images="post.images" />
            <div v-else class="h-full w-full bg-gray-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <div class="flex flex-1 flex-col p-4">
            <!-- Baris 1: Judul, Harga, Kuantitas -->
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 capitalize">{{ post.title }}</h3>
                    <div class="mt-1 flex items-center gap-1.5">
                        <img :src="`/storage/${post.category.icon_path}`" :alt="post.category.name" class="w-4 h-4 object-contain">
                        <span class="inline-block flex-shrink-0 rounded-full bg-orange-100 px-2 py-0.5 text-xs font-medium text-orange-800 capitalize">{{ post.category.name }}</span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0 pl-2">
                    <p class="text-lg font-semibold text-emerald-600">{{ formatRupiah(post.price) }}</p>
                    <p class="text-xs text-gray-500">{{ post.quantity_left }} tersisa</p>
                </div>
            </div>

            <!-- Baris 2: Amenities -->
            <div class="mt-4 flex flex-wrap gap-x-4 gap-y-2">
                <div v-for="amenity in post.amenities" :key="amenity.id" class="flex items-center gap-1 text-xs text-gray-600 font-medium capitalize">
                    <img :src="`/storage/${amenity.icon_path}`" :alt="amenity.name" class="w-4 h-4 object-contain">
                    <span>{{ amenity.name }}</span>
                </div>
            </div>

            <!-- Baris 3: Tombol -->
            <div class="mt-6 flex flex-1 items-end justify-end">
                <Link :href="route('gazebo.detail', post.id)" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Lihat Detail
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
