<script setup>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import DrawerSide from "@/Components/DrawerSide.vue";
</script>

<template>
    <div class="min-h-screen flex bg-base-300">
        <div class="drawer">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <!-- Navbar -->
                <Navbar />

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
</template>

<style scoped>

</style>
