<script setup>
import OwnerLayout from "@/Layouts/OwnerLayout.vue";
import Modal from "@/Components/Modal.vue";
import Pagination from "@/Components/Pagination.vue";
import dayjs from "dayjs";
import { defineProps, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import {EyeIcon} from "@heroicons/vue/24/solid";

defineOptions({
    layout: OwnerLayout
});

const props = defineProps({
    bookings: Object,
});

const deletePost = ref(null);
const deleteForm = useForm({});
const showModal = ref(false);

const confirmDelete = (post) => {
    deletePost.value = post;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    deletePost.value = null;
};

const performDelete = () => {
    if (deletePost.value) {
        deleteForm.delete(route('admin.post.delete', deletePost.value.id), {
            onSuccess: () => {
                closeModal();
            },
        });
    }
};

const formatDate = (dateString) => {
    return dayjs(dateString).format('ddd, DD MMM YYYY');
};
</script>

<template>
    <Head title="Dashboard" />

    <div class="px-3">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- Table content remains unchanged -->
                <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Customer</th>
                    <th>Post</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Detail</th>
                    <th></th>
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
                    <td class="text-center">
                        <div class="capitalize">
                            {{ booking.status }}
                        </div>
                    </td>
                    <td>
                        <div class="flex">
                            <a class="btn btn-info btn-sm mx-auto"
                               :href="route('admin.post.view', booking.id)"
                               target="_blank"
                            >
                                <EyeIcon class="size-5 text-center text-white"/>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="flex">
                            <button @click="confirmDelete(booking)" class="btn btn-success btn-sm mr-auto ml-1 text-white">Accept</button>
                            <button @click="confirmDelete(booking)" class="btn btn-error btn-sm mr-auto ml-1 text-white">Reject</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <Pagination :links="bookings.links" />
    </div>

    <!-- Delete Confirmation Modal -->
    <Modal :show="showModal" @close="closeModal">
        <div class="p-6">
            <h3 class="text-lg font-bold">Confirm Deletion</h3>
            <p class="py-4">Are you sure you want to delete <strong>{{ deletePost?.name }}</strong>?</p>
            <div class="flex justify-end gap-3">
                <button class="btn" @click="closeModal">Cancel</button>
                <button class="btn btn-error" @click="performDelete">Delete</button>
            </div>
        </div>
    </Modal>
</template>

<style scoped>

</style>
