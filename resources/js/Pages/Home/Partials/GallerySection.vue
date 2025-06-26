<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Pagination } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';

const modules = [Autoplay, Pagination];

const images = [
    '/storage/images/gallery/1.jpeg',
    '/storage/images/gallery/2.jpeg',
    '/storage/images/gallery/3.jpeg',
    '/storage/images/gallery/4.jpeg',
    '/storage/images/gallery/5.jpeg',
    '/storage/images/gallery/6.jpeg',
    '/storage/images/gallery/7.jpeg',
    '/storage/images/gallery/8.jpeg',
    '/storage/images/gallery/9.jpeg',
    '/storage/images/gallery/10.jpeg',
    '/storage/images/gallery/11.jpeg',
    '/storage/images/gallery/12.jpeg',
    '/storage/images/gallery/13.jpg',
    '/storage/images/gallery/14.jpg',
    '/storage/images/gallery/15.jpg',
    '/storage/images/gallery/16.jpg',
    '/storage/images/gallery/17.jpg',
    '/storage/images/gallery/18.jpg',
    '/storage/images/gallery/19.jpg',
    '/storage/images/gallery/20.jpg',
    '/storage/images/gallery/21.jpg',
    '/storage/images/gallery/22.jpg',
    '/storage/images/gallery/23.jpg',
    '/storage/images/gallery/24.jpg',
    '/storage/images/gallery/25.jpg',
    '/storage/images/gallery/26.jpg',
    '/storage/images/gallery/27.jpg',
    '/storage/images/gallery/28.jpg',
    '/storage/images/gallery/29.jpg',
    '/storage/images/gallery/30.jpg',
    '/storage/images/gallery/31.jpg',
    '/storage/images/gallery/32.jpg',
];
</script>

<template>
    <section id="gallery" class="py-20 px-6 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-4" data-aos="fade-up">Unforgettable Moments</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
                See the joy of our visitors who have created beautiful memories with us at IndoBeach.
            </p>

            <div data-aos="fade-up" data-aos-delay="200">
                <swiper
                    :modules="modules"
                    :loop="true"
                    :grabCursor="true"
                    :centeredSlides="true"
                    :slidesPerView="'auto'"
                    :spaceBetween="30"
                    :autoplay="{
                        delay: 3000,
                        disableOnInteraction: false,
                    }"
                    :pagination="{
                        clickable: true,
                    }"
                    :breakpoints="{
                        640: { slidesPerView: 2, spaceBetween: 20 },
                        768: { slidesPerView: 3, spaceBetween: 30 },
                        1024: { slidesPerView: 4, spaceBetween: 40 }
                    }"
                    class="mySwiper w-full"
                    style="padding-bottom: 40px;"
                >
                    <swiper-slide v-for="(img, index) in images" :key="index" class="w-auto">
                        <img :src="img" class="rounded-xl shadow-md h-96 w-full object-cover" :alt="'Galeri ' + (index + 1)">
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
