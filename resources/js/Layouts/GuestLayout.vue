<script setup>
import CustomerNavbar from "@/Components/Navigation/CustomerNavbar.vue";
import CustomerDrawer from "@/Components/Drawer/CustomerDrawer.vue";
import Footer from "@/Components/Footer.vue";

import AOS from "aos";
import "aos/dist/aos.css";
import {onMounted, provide, ref} from "vue";
import ToastContainer from "@/Components/Toast/ToastContainer.vue";

onMounted(() => {
    AOS.init({ duration: 1000, once: true });

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => {
                    console.log('Service Worker: Berhasil didaftarkan, scope:', registration.scope);
                })
                .catch(error => {
                    console.log('Service Worker: Pendaftaran gagal:', error);
                });
        });
    }
});

const navbarTransparent = ref(false);

const toggleNavbar = (transparent) => {
    navbarTransparent.value = transparent;
};

provide('toggleNavbar', toggleNavbar);
</script>

<template>
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <CustomerNavbar :transparent="navbarTransparent" />

            <ToastContainer :flash="$page.props.flash" />

            <div class="min-h-screen bg-white">
                <slot />
            </div>
        </div>
        <CustomerDrawer />
    </div>
    <Footer />
</template>

<style scoped>

</style>
