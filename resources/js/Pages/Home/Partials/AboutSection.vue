<script setup>

</script>

<template>
    <section id="about" class="py-20 px-6 bg-slate-50">
        <div class="container mx-auto grid md:grid-cols-2 gap-12 items-center">
            <!-- Peta Lokasi -->
            <div class="w-full h-80 md:h-full rounded-2xl overflow-hidden shadow-xl" data-aos="fade-right">
                <iframe
                    class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.9518988712803!2d125.03494237496562!3d1.194080298794519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32873dc90b1448c1%3A0xecc98df8c60898c9!2sPantai%20Indo%20Beach!5e0!3m2!1sen!2sid!4v1741861420597!5m2!1sen!2sid"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="location"
                >
                </iframe>
            </div>

            <!-- Info Kontak -->
            <div class="space-y-8" data-aos="fade-left">
                <h2 class="text-4xl font-bold text-gray-800">Hubungi Kami & Informasi</h2>
                <p class="text-gray-600">Punya pertanyaan atau butuh bantuan? Jangan ragu untuk menghubungi kami. Kami buka setiap hari untuk melayani Anda.</p>

                <div class="space-y-6">
                    <!-- Item Info Jam Operasional -->
                    <div class="flex items-start gap-4">
                        <div class="bg-sky-100 p-3 rounded-full text-sky-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-700">Jam Operasional</h4>
                            <p class="text-gray-600">Setiap Hari, 24 Jam</p>
                        </div>
                    </div>
                    <!-- Item Info Telepon -->
                    <div class="flex items-start gap-4">
                        <div class="bg-sky-100 p-3 rounded-full text-sky-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-700">Telepon</h4>
                            <p class="text-gray-600">+62 898 2000 325</p>
                        </div>
                    </div>
                    <!-- Item Info Alamat -->
                    <div class="flex items-start gap-4">
                        <div class="bg-sky-100 p-3 rounded-full text-sky-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-700">Alamat</h4>
                            <p class="text-gray-600">Lalumpe, Kombi, Kab. Minahasa, Sulawesi Utara</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
