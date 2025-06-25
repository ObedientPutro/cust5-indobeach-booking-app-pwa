<script setup>
defineProps({
    placeholder: {
        type: String,
        default: 'Cari gazebo, cottage, atau lainnya...'
    }
});
const searchTerm = defineModel();
</script>

<template>
    <div class="relative w-full">
        <input
            type="search"
            :placeholder="placeholder"
            v-model="searchTerm"
            class="w-full rounded-lg border-gray-300 py-3 pl-4 pr-12 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
        >
        <div class="absolute inset-y-0 right-0 grid w-12 place-content-center">
            <button type="button" class="text-gray-600 hover:text-gray-700">
                <span class="sr-only">Cari</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
