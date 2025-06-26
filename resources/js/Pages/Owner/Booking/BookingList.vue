<script setup>
import { defineOptions, computed } from 'vue'
import { Head } from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import { EyeIcon } from "@heroicons/vue/24/solid";
import dayjs from "dayjs";
import OwnerLayout from "@/Layouts/OwnerLayout.vue";

defineOptions({
    layout: OwnerLayout
});

const props = defineProps({
    bookings: {
        type: Object,
        required: true,
    }
})

const formatDate = (dateString) => {
    return dayjs(dateString).format('ddd, DD MMM YYYY');
};
</script>

<template>
    <Head title="Bookings" />

    <div class="px-3">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- Table content remains unchanged -->
                <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Booked Post</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(booking, index) in bookings.data" :key="booking.id">
                    <td class="max-md:w-80">{{ index + bookings.from }}</td>
                    <td class="text-center">
                        <div class="capitalize">
                            {{ booking.user.name }}
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="capitalize">
                            {{ booking.post.title }}
                        </div>
                    </td>
                    <td class="text-center">{{ formatDate(booking.start_date) }}</td>
                    <td class="text-center">{{ formatDate(booking.end_date) }}</td>
                    <td class="text-center">{{ $formatRupiah(booking.total_price) }}</td>
                    <td class="text-center">
                        <div class="capitalize">
                            {{ booking.status }}
                        </div>
                    </td>
                    <td>
                        <div class="flex">
                            <a class="btn btn-info btn-sm mx-auto"
                               target="_blank"
                               :href="route('admin.booking.view', booking.id)"
                            >
                                <EyeIcon class="size-5 text-center text-white"/>
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <Pagination :links="bookings.links" />
    </div>
</template>

<style scoped>

</style>
