<script setup>
import { Head } from "@inertiajs/vue3";
import { defineOptions } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Pagination, Autoplay } from 'swiper/modules';

defineOptions({
    layout: GuestLayout
});

const props = defineProps({
    posts: Object,
});

console.log(props.posts);
</script>

<template>
<!--    <pre>{{ posts }}</pre>-->
    <Head title="Gazebo" />

    <div class="bg-white pt-12">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8" data-aos="zoom-in">
            <h2 class="sr-only">Gazebo</h2>

            <div class="grid grid-cols-1 gap-x-6 gap-y-14 sm:grid-cols-2 lg:grid-cols-3">
                <a v-for="post in posts.data" :key="post.id" :href="post.url ?? '#'" class="group border border-gray-200 rounded-lg shadow-md p-2">
                    <div class="relative">
                        <Swiper
                            :slides-per-view="1"
                            :loop="true"
                            :pagination="{ clickable: true }"
                            :autoplay="{ delay: 3000, disableOnInteraction: false }"
                            :modules="[Pagination, Autoplay]"
                            class="rounded-lg"
                        >
                            <SwiperSlide v-for="(image, index) in post.images" :key="index">
                                <img
                                    :src="`/storage/${image.image_path}`"
                                    :alt="post.name"
                                    class="aspect-square w-full bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]" />
                            </SwiperSlide>
                        </Swiper>
                        <!-- Price Tag -->
                        <p class="absolute top-0 text-sm text-center font-medium text-gray-900 bg-amber-300 px-2 py-1 rounded-tl-lg rounded-br-lg shadow-md z-10">
                            {{ $formatRupiah(post.price) }}
                        </p>
                    </div>
                    <div class="px-4 mt-2">
                        <h3 class="font-bold text-center">{{ post.name }}</h3>
                        <p class="text-xs mt-1 text-center">{{ post.description }}</p>
                        <div class="divider divider-vertical m-0"></div>
                        <div class="flex flex-row">
                            <p class="text-xs w-1/3">
                                <strong>Cocok untuk:</strong>
                            </p>
<!--                            <p class="text-xs capitalize text-start w-2/3">-->
<!--                                {{ post.rules.map(rule => rule.condition?.name).filter(name => name).join(', ') }}-->
<!--                            </p>-->
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
