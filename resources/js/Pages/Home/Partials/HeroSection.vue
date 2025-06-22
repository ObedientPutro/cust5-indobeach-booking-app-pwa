<script setup>
import BackgroundImageDesktop from "@/Components/Background/BackgroundImageDesktop.vue";
import BackgroundImageMobile from "@/Components/Background/BackgroundImageMobile.vue";
</script>

<template>
    <section id="home" class="relative isolate px-6 lg:px-8 overflow-hidden bg-blue-400">
        <div class="absolute inset-x-0 -z-10 transform-gpu" aria-hidden="true">
            <div class="m-0 p-0 max-md:hidden">
                <BackgroundImageDesktop />
            </div>
            <div class="m-0 p-0 md:hidden lg:hidden">
                <BackgroundImageMobile />
            </div>
        </div>

        <!-- Konten dari kode asli Anda -->
        <div class="mx-auto max-w-2xl my-32 max-sm:mt-24 max-sm:mb-8">
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
</template>

<style scoped>

</style>
