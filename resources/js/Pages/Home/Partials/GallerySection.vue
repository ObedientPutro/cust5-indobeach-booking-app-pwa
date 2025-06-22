<script setup>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';

// import required modules
import { Autoplay, Pagination } from 'swiper/modules';

const modules = [Autoplay, Pagination];

// Daftar gambar dari kode asli Anda
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
];
</script>

<template>
    <section id="gallery" class="py-20 px-6 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-4" data-aos="fade-up">Momen Tak Terlupakan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
                Lihat keceriaan para pengunjung yang telah menciptakan kenangan indah bersama kami di IndoBeach.
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
