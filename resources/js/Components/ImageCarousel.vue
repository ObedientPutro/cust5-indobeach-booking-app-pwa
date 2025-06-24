<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/thumbs';

const props = defineProps({
    images: {
        type: Array,
        required: true,
    }
});
</script>

<template>
    <div class="relative w-full">
        <!-- Main carousel -->
        <Swiper
            :slides-per-view="1"
            :loop="true"
            :modules="[ Pagination, Autoplay ]"
            :pagination="{ clickable: true }"
            :autoplay="{ delay: 3000, disableOnInteraction: false }"
            class="rounded-xl"
        >
            <SwiperSlide v-for="(img, index) in images" :key="index">
                <img
                    :src="`/storage/${img.image_path}`"
                    class="aspect-1 bg-gray-200 object-cover"
                    :alt="'image ' + index"
                />
            </SwiperSlide>
        </Swiper>
    </div>
</template>

<style scoped>

</style>
