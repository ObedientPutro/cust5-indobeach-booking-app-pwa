<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import dayjs from "dayjs";

const props = defineProps({
    booking: Object,
});

const formatDate = (dateString) => {
    return dayjs(dateString).format('dddd, D MMMM YYYY');
};

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
    <div :class="[
        'bg-white rounded-xl shadow-sm border overflow-hidden transition-all hover:shadow-md',
        {'opacity-70': ['rejected', 'cancelled'].includes(booking.status)}
    ]">
        <div class="flex flex-col sm:flex-row">

            <div class="sm:w-1/3 md:w-1/4 flex-shrink-0">
                <img v-if="booking.post.images && booking.post.images.length > 0" :src="`/storage/${booking.post.images[0].image_path}`" :alt="booking.post.title" class="h-48 w-full object-cover sm:h-full">
                <div v-else class="h-48 w-full bg-gray-200 sm:h-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
            </div>

            <div class="p-6 flex flex-col flex-grow">
                <div class="flex-grow">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-start">
                        <div>
                            <span :class="['inline-flex items-center rounded-full px-3 py-1 text-xs font-medium capitalize', booking.status_info.color_class]">
                                {{ booking.status_info.label }}
                            </span>
                            <h3 class="mt-2 text-xl font-bold text-gray-900 capitalize">{{ booking.post.title }}</h3>
                        </div>
                        <p class="text-lg font-semibold text-gray-800 mt-2 sm:mt-0">{{ formatRupiah(booking.total_price) }}</p>
                    </div>
                    <div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-x-6 gap-y-2 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.75 3a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 015.75 3zm-2.25.75a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM12 4.25a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5zM5.75 6a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 015.75 6zm-2.25.75a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM12 7.25a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5zM5.75 9a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 015.75 9zm-2.25.75a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM12 10.25a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5zM14.25 3a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5A.75.75 0 0114.25 3zm-2.25.75a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM16.5 6a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5a.75.75 0 01.75-.75zm-2.25.75a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM16.5 9a.75.75 0 01.75.75v.5a.75.75 0 01-1.5 0v-.5a.75.75 0 01.75-.75zm-2.25.75a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM9.5 4.25a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5zM9.5 7.25a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5zM9.5 10.25a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5zM3 15.25a.75.75 0 000 1.5h14a.75.75 0 000-1.5H3zM2.25 13A.75.75 0 013 12.25h14a.75.75 0 010 1.5H3a.75.75 0 01-.75-.75z" clip-rule="evenodd" /></svg>
                            <span>{{ formatDate(booking.start_date) }} - {{ formatDate(booking.end_date) }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 sm:mt-0 flex flex-shrink-0 items-end">
                    <Link
                        :href="route('booking.detail', booking.id)"
                        :class="[
                            'rounded-md px-4 py-2 text-sm font-semibold text-white shadow-sm',
                            ['rejected', 'cancelled'].includes(booking.status) ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700'
                        ]"
                        :as="['rejected', 'cancelled'].includes(booking.status) ? 'button' : 'a'"
                        :disabled="['rejected', 'cancelled'].includes(booking.status)"
                    >
                        Lihat Invoice
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
