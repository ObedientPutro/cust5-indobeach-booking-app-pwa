<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    message: String,
    type: {
        type: String,
        default: 'success',
    },
    duration: {
        type: Number,
        default: 3000,
    }
});

const visible = ref(false);

const toastClass = ref(props.type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white');

onMounted(() => {
    visible.value = true;

    setTimeout(() => {
        visible.value = false;
    }, props.duration);
});

</script>

<template>
    <transition name="slide-fade">
        <div v-if="visible" class="p-4 rounded-lg shadow-lg w-96 mb-4" :class="toastClass">
            {{ message }}
        </div>
    </transition>
</template>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.5s ease-out;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: translateX(100%);
}
</style>
