<script setup>

</script>

<template>
    <section id="fasilitas" class="py-20 px-6 bg-slate-50">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-4" data-aos="fade-up">Our Featured Facilities</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
                Choose the accommodation that best suits your vacation, from private cottages to gazebos for relaxing with the family.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card Fasilitas 1: Cottage -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 group" data-aos="fade-up" data-aos-delay="200">
                    <img src="/storage/images/posts/3-4.jpg" alt="Cottage Tepi Pantai" class="w-full h-56 object-cover">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Beachside Cottage</h3>
                        <p class="text-gray-600 mb-4">Enjoy the comfort of staying with a direct view of the open sea from your private cottage.</p>
                        <a :href="route('gazebo.index')" class="font-bold text-sky-500 hover:text-sky-600 group-hover:tracking-wider transition-all">See Details →</a>
                    </div>
                </div>

                <!-- Card Fasilitas 2: Gazebo -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 group" data-aos="fade-up" data-aos-delay="300">
                    <img src="/storage/images/posts/2-2.jpg" alt="Gazebo Keluarga" class="w-full h-56 object-cover">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Family Gazebo</h3>
                        <p class="text-gray-600 mb-4">The perfect place to gather, eat together, and relax while enjoying the beach breeze.</p>
                        <a :href="route('gazebo.index')" class="font-bold text-sky-500 hover:text-sky-600 group-hover:tracking-wider transition-all">See Details →</a>
                    </div>
                </div>

                <!-- Card Fasilitas 3: Camping -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 group" data-aos="fade-up" data-aos-delay="400">
                    <img src="/storage/images/posts/1-2.jpg" alt="Peralatan Camping" class="w-full h-56 object-cover">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Camping Equipment</h3>
                        <p class="text-gray-600 mb-4">Rent a tent and all the equipment you need for a beachside camping experience.</p>
                        <a :href="route('gazebo.index')" class="font-bold text-sky-500 hover:text-sky-600 group-hover:tracking-wider transition-all">See Details →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
