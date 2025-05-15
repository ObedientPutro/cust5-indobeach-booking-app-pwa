<script setup>
import { defineOptions, computed } from 'vue'
import { Head } from '@inertiajs/vue3';
import dayjs from "dayjs";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineOptions({
    layout: GuestLayout
});

const props = defineProps({
    booking: {
        type: Object,
        required: true,
    },
    isUploadPayment: {
        type: Boolean,
        required: true,
    }
})

const formatDate = (dateString) => {
    return dayjs(dateString).format('ddd, DD MMM YYYY');
};
</script>

<template>
    <Head :title="`Booking Detail - ${booking.post.title}`" />

    <div class="max-w-3xl mx-auto p-6 mt-32 mb-6 bg-gray-100 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-center mb-6 capitalize">Invoice for {{ booking.post.title }}</h1>

        <div class="space-y-4 text-gray-700">
            <div>
                <p class="capitalize"><span class="font-semibold">Name:</span> {{ booking.user.name }}</p>
                <p><span class="font-semibold">Email:</span> {{ booking.user.email }}</p>
                <p><span class="font-semibold">Phone:</span> {{ booking.user.phone_number }}</p>
            </div>

            <div>
                <p><span class="font-semibold">Start Date:</span> {{ formatDate(booking.start_date) }}</p>
                <p><span class="font-semibold">End Date:</span> {{ formatDate(booking.end_date) }}</p>
            </div>

            <div>
                <p class="text-lg font-semibold">Total Price: {{ $formatRupiah(booking.total_price) }}</p>
            </div>

            <div>
                <p class="font-semibold mb-2">Payment Proof:</p>
                <img
                    v-if="booking.payment_image_path"
                    :src="`/storage/${booking.payment_image_path}`"
                    alt="Payment Proof"
                    class="w-full max-w-md border rounded"
                />
                <p v-else class="text-red-500">No payment proof uploaded.</p>
                <a
                    v-if="isUploadPayment"
                    :href="route('booking.payment', booking.id)"
                    class="cursor-pointer mt-3 btn bg-blue-600 text-white px-6 rounded-lg hover:bg-blue-700 transition-all duration-200">
                    Upload Payment
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
