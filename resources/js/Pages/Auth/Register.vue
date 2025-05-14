<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineOptions, inject } from "vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import TextInput from "@/Components/Input/TextInput.vue";
import InputError from "@/Components/Input/InputError.vue";
import TextareaInput from "@/Components/Input/TextareaInput.vue";

defineOptions({
    layout: GuestLayout,
})

const toggleNavbar = inject('toggleNavbar');
toggleNavbar(false);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    phone_number: '',
    address: '',
});

const submit = () => {
    form.post(route('register'), {
        onSuccess: () => {
            form.reset();
        },
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        }
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-20 lg:px-8" data-aos="zoom-in">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm" data-aos="fade-down">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Register</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm" data-aos="zoom-out">
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="email"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="mt-4">
                    <InputLabel for="phone_number" value="Phone Number" />

                    <TextInput
                        id="phone_number"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.phone_number"
                        required
                        autocomplete="phone_number"
                    />

                    <InputError class="mt-2" :message="form.errors.phone_number" />
                </div>

                <div class="mt-4">
                    <InputLabel for="address" value="Address" />

                    <TextareaInput
                        id="address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.address"
                        required
                        autofocus
                        autocomplete="address"
                    />

                    <InputError class="mt-2" :message="form.errors.address" />
                </div>

                <div class="flex items-center py-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>
                </div>

                <!-- Submit Button -->
                <div class="form-control">
                    <button type="submit" class="btn btn-info w-full" :disabled="form.processing">
                        <span v-if="form.processing" class="loading loading-spinner loading-md"></span>
                        <span v-else>Register</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
