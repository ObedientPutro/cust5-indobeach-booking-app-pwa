<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BackgroundImageDesktop from "@/Components/Background/BackgroundImageDesktop.vue";
import BackgroundImageMobile from "@/Components/Background/BackgroundImageMobile.vue";
import {Head} from "@inertiajs/vue3";
import {inject, onBeforeMount, onMounted, onUnmounted, ref} from "vue";

import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/effect-coverflow';
import 'swiper/css/autoplay';
import { EffectCoverflow, Autoplay } from 'swiper/modules';

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
});

defineOptions({
    layout: GuestLayout
});
</script>

<template>
    <Head title="Home" />

    <!-- Hero Section -->
    <section id="home" class="relative isolate px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-x-0 -z-10 transform-gpu" aria-hidden="true">
            <div class="m-0 p-0 max-md:hidden">
                <BackgroundImageDesktop />
            </div>
            <div class="m-0 p-0 md:hidden lg:hidden">
                <BackgroundImageMobile />
            </div>
        </div>

        <div class="mx-auto max-w-2xl py-32 sm:py-48">
            <div class="text-center">
                <h1 class="text-5xl font-black text-white sm:text-7xl" data-aos="zoom-out">Where Family Memories Begin</h1>
                <p class="mt-8 text-pretty text-lg font-medium text-white sm:text-xl/8" data-aos="fade-up">
                    Splash in turquoise waters, build sandcastles, and share sunsets together.<br />
                    Indo Beach & Resort is your perfect family escape—relax, explore, and reconnect.
                </p>
                <div class="mt-10 flex items-center justify-center" data-aos="zoom-in">
                    <a
                        :href="route('gazebo.index')"
                        class="btn btn-info rounded-md px-6 text-sm font-black text-white shadow-sm">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Gallery Section -->
    <div id="gallery" class="py-10"></div>
    <section class="px-10 lg:px-20 bg-white text-center" data-aos="zoom-in">
        <h2 class="text-4xl font-bold text-blue-400" data-aos="zoom-out">Our Customer Gallery</h2>
        <div class="w-full flex justify-center items-center py-8">
            <Swiper
                :effect="'coverflow'"
                :grabCursor="true"
                :centeredSlides="true"
                :slidesPerView="1.5"
                :loop="true"
                :autoplay="{ delay: 2500, disableOnInteraction: false }"
                :modules="[EffectCoverflow, Autoplay]"
                :coverflowEffect="{
                    rotate: 0,
                    stretch: 0,
                    depth: 200,
                    modifier: 1,
                    slideShadows: false,
                }"
                class="mySwiper w-full max-w-4xl"
                :breakpoints="{
                    640: { slidesPerView: 1.5 },
                    768: { slidesPerView: 2.5 },
                    1024: { slidesPerView: 3 }
                }"
            >
                <SwiperSlide
                    v-for="(img, index) in images"
                    :key="index"
                    class="flex justify-center items-center"
                >
                    <div class="relative w-[80%] aspect-[4/5] overflow-hidden rounded-lg">
                        <img
                            :src="img"
                            alt="Gallery Image"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                        />
                    </div>
                </SwiperSlide>
            </Swiper>
        </div>
    </section>


    <!-- About Section -->
    <div id="about" class="py-10"></div>
    <section class="px-10 lg:px-20 pb-20  bg-white text-center" data-aos="zoom-in">
        <h2 class="text-4xl font-bold text-blue-400 mb-10" data-aos="zoom-out">About Us</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 container mx-auto text-left items-center">
            <div class="w-full h-64 md:h-[400px]" data-aos="fade-right">
                <iframe
                    class="w-full h-full rounded-lg shadow-md"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.9518988712803!2d125.03494237496562!3d1.194080298794519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32873dc90b1448c1%3A0xecc98df8c60898c9!2sPantai%20Indo%20Beach!5e0!3m2!1sen!2sid!4v1741861420597!5m2!1sen!2sid"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <div class="space-y-6" data-aos="fade-left">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Open Days</h3>
                    <p class="text-gray-600">Monday - Sunday</p>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Open Hours</h3>
                    <p class="text-gray-600">24 Hours</p>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Phone Number</h3>
                    <p class="text-gray-600">+62 898 2000 325</p>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Email</h3>
                    <p class="text-gray-600">info@indobeachresort.com</p>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Address</h3>
                    <p class="text-gray-600">Lalumpe, Kombi, Minahasa Regency, North Sulawesi</p>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.mySwiper {
    height: 400px;
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
}

.swiper-slide img {
    transition: all 0.3s ease;
}

/* Optional: Add shadows or dimming on side slides */
.swiper-slide-prev img,
.swiper-slide-next img {
    opacity: 0.6;
    transform: scale(0.8);
    transition: all 0.3s ease;
}

.swiper-slide-active img {
    opacity: 1;
    transform: scale(1);
}
</style>
