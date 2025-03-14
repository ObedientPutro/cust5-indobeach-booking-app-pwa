<script setup>
import OwnerLayout from "@/Layouts/OwnerLayout.vue";
import Modal from "@/Components/Modal.vue";
import Pagination from "@/Components/Pagination.vue";
import dayjs from 'dayjs';
import 'dayjs/locale/en';
import { defineProps, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({
    layout: OwnerLayout
});

const props = defineProps({
    categories: Object,
});

const deleteCategory = ref(null);
const deleteForm = useForm({});
const showModal = ref(false);

const confirmDelete = (category) => {
    deleteCategory.value = category;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    deleteCategory.value = null;
};

const performDelete = () => {
    if (deleteCategory.value) {
        deleteForm.delete(route('admin.category.delete', deleteCategory.value.id), {
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
    <Head title="Category" />

    <div class="px-3">
        <div class="overflow-x-auto">
            <table class="table">
                <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Posts</th>
                    <th>
                        <div class="flex">
                            <a class="btn btn-success btn-sm mx-auto" :href="route('admin.category.new')">Add</a>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(category, index) in categories.data" :key="category.id">
                    <td class="text-center">{{ index + categories.from }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask h-12 w-12">
                                    <img :src="`/storage/${category.icon_path}`" :alt="category.name" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold capitalize">{{ category.name }}</div>
                                <div class="text-xs opacity-50">Created at {{ formatDate(category.created_at) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">{{ category.posts_count }}</td>
                    <td>
                        <div class="flex">
                            <a :href="route('admin.category.modify', category.id)" class="btn btn-warning btn-sm ml-auto mr-1">Edit</a>
                            <button @click="confirmDelete(category)" class="btn btn-error btn-sm mr-auto ml-1">Delete</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <Pagination :links="categories.links" />
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <Modal :show="showModal" @close="closeModal">
        <div class="p-6">
            <h3 class="text-lg font-bold">Confirm Deletion</h3>
            <p class="py-4">Are you sure you want to delete <strong>{{ deleteCategory?.name }}</strong>?</p>
            <div class="flex justify-end gap-3">
                <button class="btn" @click="closeModal">Cancel</button>
                <button class="btn btn-error" @click="performDelete">Delete</button>
            </div>
        </div>
    </Modal>
</template>

<style scoped>

</style>
