<script setup>
import OwnerLayout from "@/Layouts/OwnerLayout.vue";
import Modal from "@/Components/Modal.vue";
import Pagination from "@/Components/Pagination.vue";
import dayjs from "dayjs";
import { defineProps, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import { EyeIcon } from "@heroicons/vue/24/solid";

defineOptions({
    layout: OwnerLayout
});

const props = defineProps({
    posts: Object,
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
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Preview</th>
                    <th>
                        <div class="flex">
                            <a class="btn btn-success btn-sm mx-auto" :href="route('admin.post.new')">Add</a>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(post, index) in posts.data" :key="post.id">
                    <td class="max-md:w-80">{{ index + posts.from }}</td>
                    <td class="max-md:w-1/4">
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask h-12 w-12">
                                    <img
                                        :src="`/storage/${post.images[0].image_path}`"
                                        :alt="post.id" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold capitalize">{{ post.title }}</div>
                                <div class="text-sm opacity-50">Created at {{ formatDate(post.created_at) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="capitalize">
                            {{ post.category.name }}
                        </div>
                    </td>
                    <td class="text-center">{{ $formatRupiah(post.price) }}</td>
                    <td class="text-center">
                        <div class="capitalize">
                            {{ post.status }}
                        </div>
                    </td>
                    <td>
                        <div class="flex">
                            <a class="btn btn-info btn-sm mx-auto"
                               :href="route('admin.post.view', post.id)"
                               target="_blank"
                            >
                                <EyeIcon class="size-5 text-center text-white"/>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="flex">
                            <a :href="route('admin.post.modify', post.id)" class="btn btn-warning btn-sm ml-auto mr-1">Edit</a>
                            <button @click="confirmDelete(post)" class="btn btn-error btn-sm mr-auto ml-1">Delete</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <Pagination :links="posts.links" />
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
