<script setup>
import { Head } from "@inertiajs/vue3";
import { defineOptions, inject } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BookingCard from "@/Pages/Gazebo/List/Partial/BookingCard.vue";

defineOptions({
    layout: GuestLayout,
})

const props = defineProps({
    post: {
        type: Object,
        required: true,
    }
});

const toggleNavbar = inject('toggleNavbar');
toggleNavbar(false);

</script>

<template>
    <Head :title="`${post.title}`"/>

    <pre>{{ post }}</pre>

</template>

<style scoped>

</style>
