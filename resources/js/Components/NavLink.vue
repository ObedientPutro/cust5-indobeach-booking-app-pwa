<script setup>
import { computed } from 'vue';
import {Link, router} from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
    method: {
        type: String,
        default: 'get',
    },
    transparent: {
        type: Boolean,
        default: false,
    },
});

const classes = computed(() => {
    if (props.transparent) {
        return props.active
            ? 'text-gray-400 hover:text-gray-400 hover:bg-black/25 focus:text-gray-400 focus:bg-black/25'
            : 'text-white hover:text-white hover:bg-black/25 focus:text-white focus:bg-black/25';
    }
    return props.active
        ? 'text-blue-400 hover:text-white hover:bg-blue-400 focus:text-white focus:bg-blue-400'
        : 'text-black hover:text-white hover:bg-blue-400 focus:text-white focus:bg-blue-400';
});

const handleClick = () => {
    if (props.method.toLowerCase() === 'post') {
        router.post(props.href);
    }
};
</script>

<template>
    <a v-if="method === 'post'" @click="handleClick" :class="`inline-flex m-auto items-center px-3 py-2 border-transparent font-black ${classes} transition duration-150 ease-in-out`">
        <slot />
    </a>
    <Link v-else :href="href" :class="`inline-flex m-auto items-center px-3 py-2 border-transparent font-black ${classes} transition duration-150 ease-in-out`">
        <slot />
    </Link>
</template>

<style scoped>

</style>
