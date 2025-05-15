<script setup>
import { Head } from "@inertiajs/vue3";
import {defineOptions, inject} from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import BookingCard from "@/Pages/Gazebo/List/Partial/BookingCard.vue";

defineOptions({
    layout: GuestLayout
});

const toggleNavbar = inject('toggleNavbar');
toggleNavbar(false);

const props = defineProps({
    posts: Object,
});
</script>

<template>
    <Head title="Gazebo" />

    <div class="bg-white pt-12">

        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8" data-aos="zoom-in">
            <div class="grid grid-cols-1 gap-6">
                <div class="lg:w-3/4 sm:w-full mx-auto">
                    <BookingCard v-for="post in posts.data" :key="post.id" :post="post" />
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>

</style>
