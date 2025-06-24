<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});
</script>

<template>
    <nav v-if="links.length > 3" class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
        <template v-for="(link, key) in links" :key="key">
            <div v-if="link.url === null"
                 class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-400 ring-1 ring-inset ring-gray-300"
                 v-html="link.label"
            />
            <Link v-else
                  :href="link.url"
                  class="relative inline-flex items-center px-4 py-2 text-sm font-semibold"
                  :class="{ 'z-10 bg-blue-600 text-white focus-visible:outline-blue-600': link.active, 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50': !link.active }"
                  v-html="link.label"
            />
        </template>
    </nav>
</template>

<style scoped>

</style>
