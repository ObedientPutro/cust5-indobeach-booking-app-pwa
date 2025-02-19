<script setup>
import { ref } from 'vue';
import Modal from "@/Components/Modal.vue";
import LoginForm from "@/Components/Form/LoginForm.vue";
import LogoImageWhite from "@/Components/LogoImageWhite.vue";

const isLoginModalOpen = ref(false);
</script>

<template>
    <div class="navbar fixed backdrop-blur-md bg-black/30 w-full lg:px-10">
        <!-- Navbar Drawer Button -->
        <div class="flex-none lg:hidden">
            <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    class="inline-block h-6 w-6 stroke-current">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>
        </div>

        <!-- Navbar Title -->
        <div class="mx-2 flex-1 px-2">
            <div class="avatar">
                <div class="w-12 max-sm:w-8 rounded">
                    <LogoImageWhite />
                </div>
            </div>
            <div class="visible">
                <a class="ml-3 text-2xl max-sm:text-lg uppercase font-black font-mono text-white">Indo Beach & Resort</a>
            </div>
        </div>

        <!-- Navbar End -->
        <div class="hidden lg:flex">
            <!-- Menu Link Button -->
            <div class="flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a :href="route('home')" class="font-bold text-base text-white">Home</a></li>
                    <li><a class="font-bold text-base text-white">About</a></li>
                    <li><a class="font-bold text-base text-white">Gallery</a></li>
                    <li><a class="font-bold text-base text-white">Contact</a></li>
                    <li><a class="font-bold text-base text-white">Cottage</a></li>
                </ul>
            </div>

            <!-- Button Right Side -->
            <div class="flex">
                <!-- Profile Button -->
                <div class="hidden">
                    <div class="divider divider-horizontal p-0 m-0"></div>
                    <div class="dropdown">
                        <div tabindex="1" role="button" class="btn btn-outline font-bold text-base">
                            <font-awesome-icon icon="fa-solid fa-user" />
                            Johnson
                        </div>
                        <ul tabindex="1"
                            class="menu menu-sm dropdown-content rounded-box z-[1] mt-3 w-40 p-2 bg-white">
                            <li><a class="font-bold">Profile</a></li>
                            <li><a class="font-bold">Booking Histories</a></li>
                            <div class="divider divider-vertical p-0 m-0"></div>
                            <li><a class="font-bold">Logout</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Authentication Button -->
                <div class="flex">
                    <a class="btn btn-outline hover:btn-info font-mono text-white"
                       @click="isLoginModalOpen = true">
                        <font-awesome-icon icon="fa-solid fa-user" />
                        Log In
                    </a>
                    <div class="divider divider-horizontal p-0 m-0"></div>
                    <a class="btn glass bg-blue-400 hover:bg-amber-400 font-mono font-black text-white">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </div>

    <keep-alive>
        <Modal :show="isLoginModalOpen" @close="isLoginModalOpen = false">
            <template #default>
                <LoginForm />
            </template>
        </Modal>
    </keep-alive>
</template>

<style scoped>

</style>
