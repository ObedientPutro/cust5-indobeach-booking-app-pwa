<script setup>
import { useForm } from '@inertiajs/vue3';
import {inject} from "vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const canCloseModal = inject('canCloseModal');
const emit = defineEmits(['close-modal']);

// Create a reactive form object
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const closeModal = () => {
    emit('close-modal');
};

const submit = () => {
    canCloseModal(false);
    form.post(route('login'), {
        onSuccess: () => {
            form.reset();
        },
        onFinish: () => {
            form.reset('password');
            canCloseModal(true);
            closeModal();
        }
    });
};
</script>

<template>
    <form @submit.prevent="submit" class="space-y-4">
        <h1 class="font-black text-2xl text-center uppercase">Log In</h1>

        <!-- Email Field -->
        <div class="form-control">
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input
                type="email"
                v-model="form.email"
                placeholder="email@example.com"
                class="input input-bordered hover:input-info focus:input-info"
                required
            />
        </div>

        <!-- Password Field -->
        <div class="form-control">
            <label class="label">
                <span class="label-text">Password</span>
            </label>
            <input
                type="password"
                v-model="form.password"
                placeholder="Password"
                class="input input-bordered hover:input-info focus:input-info"
                required
            />
        </div>

        <div class="flex">
            <label class="label cursor-pointer">
                <input
                    type="checkbox"
                    v-model="form.remember"
                    class="checkbox mr-3"
                    name="remember"
                />
                <span class="label-text font-bold">Remember me</span>
            </label>
        </div>

        <!-- Error Messages -->
        <div v-show="form.errors.email" class="text-error text-center font-bold">
            <p>{{ form.errors.email }}</p>
        </div>

        <!-- Submit Button -->
        <div class="form-control">
            <button type="submit" class="btn btn-info w-full" :disabled="form.processing">
                <span v-if="form.processing" class="loading loading-spinner loading-md"></span>
                <span v-else>Log In</span>
            </button>
        </div>
    </form>
</template>

<style scoped>

</style>
