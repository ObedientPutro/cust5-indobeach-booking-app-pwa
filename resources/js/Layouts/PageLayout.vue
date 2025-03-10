<script setup>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import DrawerSide from "@/Components/DrawerSide.vue";
import LoginForm from "@/Components/Form/LoginForm.vue";
import Modal from "@/Components/Modal.vue";
import { ref} from "vue";

const showLoginModal = ref(false);
const showRegisterModal = ref(false);

const openLoginModal = () => {
    showLoginModal.value = true;
}

const openRegisterModal = () => {
    showRegisterModal.value = true;
}

</script>

<template>
    <div class="min-h-screen flex bg-base-300">
        <div class="drawer">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <!-- Navbar -->
                <Navbar @open-login-modal="openLoginModal" />

                <!-- Page content here -->
                <div class="flex-grow">
                    <slot />
                </div>

                <!-- Footer -->
                <Footer />
            </div>

            <!-- Drawer Side -->
            <DrawerSide />
        </div>
    </div>

    <!-- Modal Handler -->
    <keep-alive>
        <Modal :show="showLoginModal" @close="showLoginModal = false">
            <template #default>
                <LoginForm />
            </template>
        </Modal>
    </keep-alive>
</template>

<style scoped>

</style>
