<script setup>
import CustomerNavbar from "@/Components/Navigation/CustomerNavbar.vue";
import CustomerDrawer from "@/Components/Drawer/CustomerDrawer.vue";
import Footer from "@/Components/Footer.vue";
import ToastContainer from "@/Components/Toast/ToastContainer.vue";

import AOS from "aos";
import "aos/dist/aos.css";
import { computed, onMounted, provide, ref } from "vue";
import { usePushNotifications } from "@/Composables/usePushNotifications";

usePushNotifications();

const user = computed(() => page.props.auth.user);

onMounted(() => {
    AOS.init({ duration: 1000, once: true });
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
        <div class="drawer-content flex flex-col overflow-x-hidden">
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
