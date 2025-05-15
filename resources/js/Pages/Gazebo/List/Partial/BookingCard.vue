<script setup>
import ImageCarousel from "@/Components/ImageCarousel.vue";

defineProps({
    post: Object
});
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 rounded-xl border border-b-gray-300 shadow-md overflow-hidden mb-6 max-md:pb-5">
        <!-- Left Column (Image Carousel) -->
        <div class="mt-auto mb-auto p-2">
            <ImageCarousel :images="post.images" />
        </div>

        <!-- Right Column (Details) -->
        <div class="mt-auto mb-auto pr-4 pl-4 justify-between">
            <!-- Row 1: Name + Category & Price -->
            <div class="flex justify-between items-center">
                <div class="text-left pr-2">
                    <h2 class="text-lg capitalize font-bold text-gray-800 mb-1">{{ post.title }}</h2>
                    <div class="flex items-center gap-2 text-xs font-bold text-orange-600">
                        <img :src="`/storage/${post.category.icon_path}`" class="w-5"/>
                        <span class="bg-orange-100 capitalize text-orange-600 px-2 py-0.5 rounded">{{ post.category.name }}</span>
                    </div>
                </div>
                <div class="text-right pl-2">
                    <p class="text-xl font-semibold text-emerald-600">{{ $formatRupiah(post.price) }}</p>
                    <p class="text-sm font-semibold text-gray-600">{{ post.quantity_left }} left</p>
                </div>
            </div>

            <!-- Row 2: Amenities -->
            <div class="flex flex-wrap gap-4 mt-6">
                <div
                    v-for="(amenity, i) in post.amenities"
                    :key="i"
                    class="flex gap-1 capitalize font-bold text-gray-700 text-xs rounded-full"
                >
                    <img :src="`/storage/${amenity.icon_path}`" class="w-4"/>
                    {{ amenity.name }}
                </div>
            </div>

            <!-- Row 3: Button -->
            <div class="mt-6 text-right">
                <a
                    :href="route('gazebo.detail', post.id)"
                    class="cursor-pointer px-4 py-3 text-sm font-medium bg-blue-600 text-white rounded-md hover:bg-blue-700"
                >
                    See More
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
