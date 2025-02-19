<script setup>
import CustomerLayout from '@/Layouts/PageLayout.vue';
import BackgroundImageDesktop from "@/Components/BackgroundImageDesktop.vue";
import BackgroundImageMobile from "@/Components/BackgroundImageMobile.vue";
import {Head} from "@inertiajs/vue3";

defineOptions({
    layout: CustomerLayout,
});
</script>

<template>
    <Head title="Home" />
    <div class="m-0 p-0 max-sm:hidden">
        <BackgroundImageDesktop />
    </div>
    <div class="m-0 p-0 md:hidden lg:hidden">
        <BackgroundImageMobile />
    </div>
</template>

<style scoped>

</style>
