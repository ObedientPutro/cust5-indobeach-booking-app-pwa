<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import dayjs from "dayjs";

const props = defineProps({
    booking: {
        type: Object,
        required: true,
    },
    isUploadPayment: {
        type: Boolean,
        required: true,
    }
});

const formatDate = (dateString) => {
    return dayjs(dateString).format('dddd, D MMMM YYYY');
};

const formatSimpleDate = (dateString) => {
    return dayjs(dateString).format('D MMM YYYY');
}

const formatRupiah = (amount) => {
    if (!amount) return "Rp 0";
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
};

// Logika untuk menentukan warna dan teks status berdasarkan Enum
const statusInfo = computed(() => {
    switch (props.booking.status) {
        case 'confirmed':
        case 'completed':
            return { text: 'Confirmed', class: 'bg-green-100 text-green-700' };
        case 'payment':
            return { text: 'Waiting for Payment', class: 'bg-blue-100 text-blue-700' };
        case 'waiting payment confirmation':
            return { text: 'Waiting Payment Confirmation', class: 'bg-yellow-100 text-yellow-800' };
        case 'waiting approval':
            return { text: 'Waiting for Approval', class: 'bg-yellow-100 text-yellow-800' };
        case 'rejected':
            return { text: 'Rejected', class: 'bg-red-100 text-red-700' };
        case 'cancelled':
            return { text: 'Cancelled', class: 'bg-gray-100 text-gray-700' };
        default:
            return { text: props.booking.status, class: 'bg-gray-100 text-gray-800' };
    }
});

// Menghitung durasi pemesanan
const bookingDuration = computed(() => {
    const start = dayjs(props.booking.start_date);
    const end = dayjs(props.booking.end_date);
    const days = end.diff(start, 'day');
    return `${days + 1} Day / ${days} Night`;
});

const printPage = () => {
    window.print();
};
</script>

<template>
    <Head :title="`Invoice #${booking.id}`" />

    <div class="bg-gray-100 py-10">
        <div class="container mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <!-- Action Header -->
            <div class="no-print mb-6 flex justify-between items-center">
                <Link :href="route('booking')" class="inline-flex items-center gap-2 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>
                    Back to History
                </Link>
                <button @click="printPage" class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M5 2.75C5 1.784 5.784 1 6.75 1h6.5c.966 0 1.75.784 1.75 1.75v3.552c.377.046.752.097 1.128.153A2.25 2.25 0 0118 8.678v4.302a2.25 2.25 0 01-1.872 2.223c-.376.056-.751.107-1.128.153v3.552c0 .966-.784 1.75-1.75 1.75h-6.5A1.75 1.75 0 015 18.25v-3.552a26.845 26.845 0 01-1.128-.153A2.25 2.25 0 012 12.98V8.678a2.25 2.25 0 011.872-2.223c.376-.056.751-.107 1.128-.153V2.75zM6.5 2.5a.25.25 0 00-.25.25v14.5c0 .138.112.25.25.25h6.5a.25.25 0 00.25-.25V2.75a.25.25 0 00-.25-.25h-6.5z" clip-rule="evenodd" /><path d="M10 12.5a.75.75 0 01-.75-.75v-1.5a.75.75 0 011.5 0v1.5a.75.75 0 01-.75-.75z" /></svg>
                    Print / Save PDF
                </button>
            </div>

            <!-- Invoice Container -->
            <div class="invoice-container bg-white rounded-xl shadow-md border">
                <!-- Invoice Header -->
                <div class="p-6 sm:p-8 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Booking Invoice</h2>
                            <p class="mt-1 text-sm text-gray-500">Booking ID #INDB-{{ booking.id }}</p>
                        </div>
                        <div class="text-left sm:text-right">
                            <span :class="['inline-flex items-center rounded-full px-3 py-1 text-sm font-medium capitalize', statusInfo.class]">
                                {{ statusInfo.text }}
                            </span>
                            <p class="mt-1 text-sm text-gray-500">Booking Date: {{ formatSimpleDate(booking.created_at) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Content Details -->
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-sm font-semibold uppercase text-gray-500 mb-3">Billed To</h3>
                            <p class="font-semibold text-gray-800 capitalize">{{ booking.user.name }}</p>
                            <p class="text-gray-600">{{ booking.user.email }}</p>
                            <p class="text-gray-600">{{ booking.user.phone_number }}</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <img v-if="booking.post.images.length > 0" :src="`/storage/${booking.post.images[0].image_path}`" alt="Facility" class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                            <img v-else src="https://placehold.co/100x100/e2e8f0/64748b?text=No+Image" alt="No Image" class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                            <div>
                                <h3 class="text-sm font-semibold uppercase text-gray-500 mb-1">Booked Facility</h3>
                                <p class="font-semibold text-gray-800 capitalize">{{ booking.post.title }}</p>
                                <p class="text-sm text-gray-600 capitalize">Category: {{ booking.post.category.name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-sm font-semibold uppercase text-gray-500 mb-4">Booking Details</h3>
                        <div class="flow-root">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Description</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Duration</th>
                                            <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">Unit Price</th>
                                            <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ formatDate(booking.start_date) }} - {{ formatDate(booking.end_date) }}</td>
                                            <td class="px-3 py-4 text-sm text-gray-500">{{ bookingDuration }}</td>
                                            <td class="px-3 py-4 text-sm text-gray-500 text-right">{{ formatRupiah(booking.post.price) }}</td>
                                            <td class="py-4 pl-3 pr-4 text-sm font-medium text-gray-900 sm:pr-0 text-right">{{ formatRupiah(booking.total_price) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <div class="w-full max-w-xs space-y-2">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>{{ formatRupiah(booking.total_price) }}</span>
                            </div>
                            <div class="flex justify-between font-bold text-gray-900 text-lg border-t pt-2">
                                <span>Total</span>
                                <span>{{ formatRupiah(booking.total_price) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t pt-6">
                        <h3 class="text-sm font-semibold uppercase text-gray-500 mb-3">Payment Proof</h3>
                        <div v-if="booking.payment_image_path">
                            <img :src="`/storage/${booking.payment_image_path}`" alt="Payment Proof" class="max-w-xs w-full rounded-lg border">
                        </div>
                        <div v-else class="text-center p-6 border-2 border-dashed rounded-lg">
                            <p class="text-gray-500 mb-4">No payment proof has been uploaded.</p>
                            <Link v-if="isUploadPayment" :href="route('booking.payment', booking.id)" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">Upload Payment</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
