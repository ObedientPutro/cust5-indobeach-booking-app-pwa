<script setup>
import { ref, watch } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import { defineOptions, inject } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { debounce } from 'lodash';

// Import komponen-komponen yang diperlukan
import BookingHistoryCard from './Partials/BookingHistoryCard.vue';
import BookingHistoryPagination from "@/Pages/Customer/Booking/Partials/BookingHistoryPagination.vue";
import BookingHistorySearchForm from "@/Pages/Customer/Booking/Partials/BookingHistorySearchForm.vue";

defineOptions({
    layout: GuestLayout
});

const toggleNavbar = inject('toggleNavbar');
toggleNavbar(false);

const props = defineProps({
    bookings: Object,
    filters: Object,
});

// State untuk fungsionalitas pencarian
const search = ref(props.filters.search);

// Fungsi untuk mengambil data baru saat pencarian berubah
watch(search, debounce((value) => {
    router.get(route('booking'), { search: value }, {
        preserveState: true,
        replace: true,
    });
}, 300));

</script>

<template>
    <Head title="Riwayat Pemesanan" />

    <div class="bg-gray-50 pt-24">
        <div class="container mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

            <!-- Header Halaman -->
            <div class="mb-10">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Riwayat Pemesanan Anda</h1>
                    <p class="mt-4 text-lg text-gray-600">Kelola dan lihat detail semua pemesanan Anda di satu tempat.</p>
                </div>
                <!-- Kolom Pencarian -->
                <div class="mt-8 max-w-lg mx-auto">
                    <BookingHistorySearchForm v-model="search" placeholder="Cari berdasarkan nama fasilitas..." />
                </div>
            </div>

            <!-- Daftar Kartu Pemesanan -->
            <div v-if="bookings.data.length > 0" class="space-y-6">
                <BookingHistoryCard v-for="booking in bookings.data" :key="booking.id" :booking="booking" />
            </div>
            <div v-else class="text-center py-16 text-gray-500">
                <p class="text-lg font-semibold">Anda belum memiliki riwayat pemesanan.</p>
                <p>Silakan jelajahi fasilitas kami dan buat pemesanan pertama Anda!</p>
            </div>

            <!-- Pagination -->
            <div v-if="bookings.data.length > 0" class="mt-10 flex justify-center">
                <BookingHistoryPagination :links="bookings.links" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
