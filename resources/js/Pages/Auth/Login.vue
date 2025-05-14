<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import { defineOptions, inject } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineOptions({
    layout: GuestLayout,
})

const toggleNavbar = inject('toggleNavbar');
toggleNavbar(false);

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onSuccess: () => {
            form.reset();
        },
        onFinish: () => {
            form.reset('password');
        }
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8" data-aos="zoom-in">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm" data-aos="fade-down">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Log In</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm" data-aos="zoom-out">
            <form @submit.prevent="submit" class="space-y-4">

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

                <!-- Error Messages -->
                <div v-show="form.errors.email" class="text-error text-center font-bold">
                    <p>{{ form.errors.email }}</p>
                </div>

                <div class="flex items-center py-2">
                    <Link
                        :href="route('register')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Not Registered?
                    </Link>
                </div>

                <!-- Submit Button -->
                <div class="form-control">
                    <button type="submit" class="btn btn-info w-full" :disabled="form.processing">
                        <span v-if="form.processing" class="loading loading-spinner loading-md"></span>
                        <span v-else>Log In</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
