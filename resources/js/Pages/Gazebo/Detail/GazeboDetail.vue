<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { defineOptions, inject } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ImageCarousel from "@/Components/ImageCarousel.vue";

defineOptions({
    layout: GuestLayout,
})

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    booking: {
        type: Object,
        required: false,
    }
});

const toggleNavbar = inject('toggleNavbar');
toggleNavbar(false);

const formatRupiah = (amount) => {
    if (!amount) return "Rp 0";
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
};

function openWhatsApp() {
    const number = '628982000325'; // Ganti dengan nomor WhatsApp Anda
    const message = `Hi, I'm interested in booking the "${props.post.title}". Is it available?`;
    const url = `https://wa.me/${number}?text=${encodeURIComponent(message)}`;
    window.open(url, '_blank');
}
</script>

<template>
    <Head :title="post.title"/>

    <!-- Wrapper Utama dengan padding atas untuk menggantikan mt-20 -->
    <div class="mt-28">
        <div class="container mx-auto max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">

            <!-- Header: Tombol Kembali -->
            <div class="flex items-center justify-start mb-8">
                <Link :href="route('gazebo.index')" class="inline-flex items-center gap-2 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                    </svg>
                    Back
                </Link>
            </div>

            <!-- Layout Detail -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-10">
                <!-- Kolom Kiri: Galeri Gambar -->
                <div class="w-full">
                    <ImageCarousel v-if="post.images && post.images.length > 0" :images="post.images" />
                    <!-- Fallback jika tidak ada gambar -->
                    <div v-else class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-xl bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <!-- Kolom Kanan: Informasi Detail -->
                <div class="flex flex-col">
                    <!-- Kategori & Judul -->
                    <div class="mb-4">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg text-blue-600">
                                <img :src="`/storage/${post.category.icon_path}`" class="w-5 h-5 object-contain" :alt="post.category.name">
                            </div>
                            <span class="inline-block rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800 capitalize">{{ post.category.name }}</span>
                        </div>
                        <h1 class="mt-3 text-4xl font-bold tracking-tight text-gray-900 capitalize">{{ post.title }}</h1>
                    </div>

                    <!-- Deskripsi -->
                    <div class="text-base text-gray-700 space-y-4 whitespace-pre-line">
                        <p>{{ post.description }}</p>
                    </div>

                    <!-- Fasilitas -->
                    <div v-if="post.amenities.length > 0" class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-900">Included Amenities</h3>
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div v-for="amenity in post.amenities" :key="amenity.id" class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                    <img :src="`/storage/${amenity.icon_path}`" :alt="amenity.name" class="w-6 h-6 object-contain">
                                </div>
                                <span class="font-medium text-gray-700 capitalize">{{ amenity.name }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kotak Aksi Pemesanan -->
                    <div class="mt-auto pt-10">
                        <div class="rounded-lg border bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Price per day</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ formatRupiah(post.price) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-green-600">{{ post.quantity_left }} units available</p>
                                </div>
                            </div>
                            <div class="mt-6">
                                <!-- Tombol Aksi Dinamis -->
                                <div v-if="booking">
                                    <Link :href="route('booking.detail', booking.id)" class="flex w-full items-center justify-center rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700">
                                        See Booking Status
                                    </Link>
                                </div>
                                <div v-else>
                                    <Link :href="route('booking.create', post.id)" class="flex w-full items-center justify-center rounded-md border border-transparent bg-blue-600 px-8 py-3 text-base font-medium text-white hover:bg-blue-700">
                                        Book Now
                                    </Link>
                                </div>
                                <button @click="openWhatsApp" class="mt-3 flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-8 py-3 text-base font-medium text-gray-700 hover:bg-gray-50">
                                    Contact via WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.swiper-pagination-bullet-active {
    background-color: #2563eb !important; /* Warna biru */
}
.swiper-button-next, .swiper-button-prev {
    color: #ffffff !important;
    background-color: rgba(0,0,0,0.3);
    border-radius: 50%;
    width: 40px !important;
    height: 40px !important;
    transition: background-color 0.3s;
}
.swiper-button-next:hover, .swiper-button-prev:hover {
    background-color: rgba(0,0,0,0.5);
}
.swiper-button-next::after, .swiper-button-prev::after {
    font-size: 18px !important;
    font-weight: 800;
}
</style>
