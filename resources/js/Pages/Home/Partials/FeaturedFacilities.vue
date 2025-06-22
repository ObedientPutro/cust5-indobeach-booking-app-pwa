<script setup>

</script>

<template>
    <section id="fasilitas" class="py-20 px-6 bg-slate-50">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-4" data-aos="fade-up">Fasilitas Unggulan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
                Pilih akomodasi yang paling sesuai untuk liburan Anda, mulai dari cottage pribadi hingga gazebo untuk bersantai bersama keluarga.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card Fasilitas 1: Cottage -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 group" data-aos="fade-up" data-aos-delay="200">
                    <img src="/storage/images/posts/3-4.jpg" alt="Cottage Tepi Pantai" class="w-full h-56 object-cover">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Cottage Tepi Pantai</h3>
                        <p class="text-gray-600 mb-4">Nikmati kenyamanan menginap dengan pemandangan langsung ke laut lepas dari cottage pribadi Anda.</p>
                        <a :href="route('gazebo.index')" class="font-bold text-sky-500 hover:text-sky-600 group-hover:tracking-wider transition-all">Lihat Detail →</a>
                    </div>
                </div>

                <!-- Card Fasilitas 2: Gazebo -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 group" data-aos="fade-up" data-aos-delay="300">
                    <img src="/storage/images/posts/2-2.jpg" alt="Gazebo Keluarga" class="w-full h-56 object-cover">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Gazebo Keluarga</h3>
                        <p class="text-gray-600 mb-4">Tempat sempurna untuk berkumpul, makan bersama, dan bersantai sambil menikmati angin pantai.</p>
                        <a :href="route('gazebo.index')" class="font-bold text-sky-500 hover:text-sky-600 group-hover:tracking-wider transition-all">Lihat Detail →</a>
                    </div>
                </div>

                <!-- Card Fasilitas 3: Camping -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 group" data-aos="fade-up" data-aos-delay="400">
                    <img src="/storage/images/posts/1-2.jpg" alt="Peralatan Camping" class="w-full h-56 object-cover">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Peralatan Camping</h3>
                        <p class="text-gray-600 mb-4">Sewa tenda dan semua perlengkapan yang Anda butuhkan untuk pengalaman berkemah di tepi pantai.</p>
                        <a :href="route('gazebo.index')" class="font-bold text-sky-500 hover:text-sky-600 group-hover:tracking-wider transition-all">Lihat Detail →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
