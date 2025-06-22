<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import { inject, onBeforeMount, onMounted, onUnmounted, ref } from "vue";

import HeroSection from "./Partials/HeroSection.vue";
import FeaturedFacilities from "./Partials/FeaturedFacilities.vue";
import GallerySection from "./Partials/GallerySection.vue";
import AboutSection from "./Partials/AboutSection.vue";

defineOptions({
    layout: GuestLayout
});

const toggleNavbar = inject('toggleNavbar');
const scrollPosition = ref(0);

const handleScroll = () => {
    scrollPosition.value = window.scrollY;
    toggleNavbar(scrollPosition.value <= 50);
};

onBeforeMount( () => {
    toggleNavbar(scrollPosition.value <= 50);
});

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    toggleNavbar(false);
});
</script>

<template>
    <Head title="Home" />

    <HeroSection />

    <main class="bg-slate-50">
        <FeaturedFacilities />
        <GallerySection />
        <AboutSection />
    </main>
</template>

<style>
.swiper-pagination-bullet-active {
    background-color: #38bdf8 !important; /* Biru langit */
}
</style>
