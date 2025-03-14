<script setup>
import {ref, watchEffect} from 'vue';
import Toast from './Toast.vue';

const props = defineProps({
    flash: Object
});

const toasts = ref([]);

const addToast = (message, type) => {
    const toast = { id: Date.now(), message, type };
    toasts.value.push(toast);

    // Remove only this toast after 3s
    setTimeout(() => {
        toasts.value = toasts.value.filter(t => t.id !== toast.id);
    }, 3000);
};

watchEffect(() => {
    if (props.flash.success) {
        addToast(props.flash.success, 'success');
        props.flash.success = null; // Reset flash message
    }
    if (props.flash.error) {
        addToast(props.flash.error, 'error');
        props.flash.error = null; // Reset flash message
    }
});
</script>

<template>
    <div class="fixed top-4 right-4 z-50 flex flex-col gap-2">
        <Toast v-for="toast in toasts" :key="toast.id" :message="toast.message" :type="toast.type" />
    </div>
</template>
