<script setup>
import CustomerNavbar from "@/Components/Navigation/CustomerNavbar.vue";
import CustomerDrawer from "@/Components/Drawer/CustomerDrawer.vue";
import Footer from "@/Components/Footer.vue";
import LoginForm from "@/Components/Form/LoginForm.vue";
import Modal from "@/Components/Modal.vue";

import AOS from "aos";
import "aos/dist/aos.css";
import {onMounted, provide, ref} from "vue";

onMounted(() => {
    AOS.init({ duration: 1000, once: true });
});

const showLoginModal = ref(false);
const showRegisterModal = ref(false);
const navbarTransparent = ref(false);
const modalCloseable = ref(true);

const openLoginModal = () => {
    showLoginModal.value = true;
}

const openRegisterModal = () => {
    showRegisterModal.value = true;
}

const canCloseModal = (state) => {
    modalCloseable.value = state;
}

const toggleNavbar = (transparent) => {
    navbarTransparent.value = transparent;
};

provide('toggleNavbar', toggleNavbar);
provide('canCloseModal', canCloseModal);
</script>

<template>
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <CustomerNavbar @open-login-modal="openLoginModal" :transparent="navbarTransparent" />

            <div class="min-h-screen">
                <slot />
            </div>
        </div>
        <CustomerDrawer />
    </div>
    <Footer />

    <!-- Modal Handler -->
    <keep-alive>
        <Modal :show="showLoginModal" @close="showLoginModal=false" :closeable="modalCloseable">
            <template #default>
                <LoginForm @close-modal="showLoginModal=false"/>
            </template>
        </Modal>
    </keep-alive>
</template>

<style scoped>

</style>
