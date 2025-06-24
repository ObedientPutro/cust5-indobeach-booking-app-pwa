<script setup>
import { ref, watch } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import { defineOptions, inject } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { debounce } from 'lodash';

import GazeboListFilterSidebar from "@/Pages/Gazebo/List/Partial/GazeboListFilterSidebar.vue";
import GazeboListSearchForm from "@/Pages/Gazebo/List/Partial/GazeboListSearchForm.vue";
import GazeboListPostCard from "@/Pages/Gazebo/List/Partial/GazeboListPostCard.vue";
import GazeboListPagination from "@/Pages/Gazebo/List/Partial/GazeboListPagination.vue";
import GazeboListMobileFilter from "@/Pages/Gazebo/List/Partial/GazeboListMobileFilter.vue";

defineOptions({
    layout: GuestLayout
});

// Matikan navbar transparan di halaman ini
const toggleNavbar = inject('toggleNavbar');
toggleNavbar(false);

const props = defineProps({
    posts: Object,
    categories: Object,
    amenities: Object,
    filters: Object,
});

const search = ref(props.filters.search);
const selectedCategories = ref(props.filters.categories || []);
const selectedAmenities = ref(props.filters.amenities || []);
const showMobileFilter = ref(false);

const refetchData = () => {
    router.get(route('gazebo.index'), {
        search: search.value,
        categories: selectedCategories.value,
        amenities: selectedAmenities.value,
    }, {
        preserveState: true,
        replace: true,
    });
};
watch(search, debounce(refetchData, 300));

const applyFilters = (payload) => {
    selectedCategories.value = payload.categories;
    selectedAmenities.value = payload.amenities;
    showMobileFilter.value = false;
    refetchData();
}
</script>

<template>
    <Head title="Jelajahi Fasilitas" />

    <div class="container mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 mt-20">
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Explore Our Facilities</h1>
            <p class="mt-4 text-lg text-gray-600">Find the perfect spot for your next getaway.</p>
        </div>

        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
            <GazeboListFilterSidebar
                :categories="categories"
                :amenities="amenities"
                :initial-categories="selectedCategories"
                :initial-amenities="selectedAmenities"
                @apply="applyFilters"
                class="hidden lg:block"
            />

            <main class="lg:col-span-3">
                <GazeboListSearchForm v-model="search" />

                <div class="mt-4 flex items-center justify-between mb-6 lg:hidden">
                    <button @click="showMobileFilter = true" type="button" class="flex items-center gap-x-2 rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.59L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
                        </svg>
                        Show Filters
                    </button>
                </div>

                <div v-if="posts.data.length > 0" class="pt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 xl:grid-cols-3">
                    <GazeboListPostCard v-for="post in posts.data" :key="post.id" :post="post" />
                </div>
                <div v-else class="pt-10 text-center text-gray-500">
                    <p>No post was found.</p>
                    <p class="text-sm">Try to change filter or your searches.</p>
                </div>

                <div class="mt-10 flex flex-col sm:flex-row items-center justify-between border-t border-gray-200 pt-6 gap-4">
                    <div class="text-sm text-gray-700">
                        Show <span class="font-medium">{{ posts.from }}</span> to <span class="font-medium">{{ posts.to }}</span> from <span class="font-medium">{{ posts.total }}</span> result
                    </div>
                    <GazeboListPagination :links="posts.links" />
                </div>
            </main>
        </div>
    </div>

    <GazeboListMobileFilter
        :show="showMobileFilter"
        :categories="categories"
        :amenities="amenities"
        :initial-categories="selectedCategories"
        :initial-amenities="selectedAmenities"
        @close="showMobileFilter = false"
        @apply="applyFilters"
    />
</template>

<style scoped>

</style>
