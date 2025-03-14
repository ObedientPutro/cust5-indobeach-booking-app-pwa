<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    links: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="sm:flex sm:flex-1 sm:items-center sm:justify-between mx-auto">
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm mx-auto" aria-label="Pagination">
                <a
                    v-for="(link, index) in links"
                    :key="index"
                    :href="link.url"
                    v-html="link.label"
                    :aria-disabled="link.url == null"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20 focus:outline-offset-0"
                    :class="{
                        'bg-blue-400 text-white': link.active,
                        'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50': !link.active,
                        'cursor-not-allowed opacity-50': link.url == null
                    }"
                ></a>
            </nav>
        </div>
    </div>
</template>

<style scoped>

</style>
