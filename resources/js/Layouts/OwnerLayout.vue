<script setup>
import OwnerHeader from "@/Components/Header/OwnerHeader.vue";
import OwnerDrawer from "@/Components/Drawer/OwnerDrawer.vue";
import ToastContainer from "@/Components/Toast/ToastContainer.vue";
import Footer from "@/Components/Footer.vue";
</script>

<template>
    <div class="drawer lg:drawer-open h-screen">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col">
            <header class="w-full bg-white border-b px-6 py-4 flex items-center justify-between">
                <OwnerHeader/>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-100 p-3 lg:p-5">
                <div class="max-w-7xl mx-auto px-1">
                    <ToastContainer :flash="$page.props.flash" />

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3 lg:p-5">
                        <slot />
                    </div>
                </div>
            </main>
        </div>

        <div class="drawer-side z-20">
            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
            <OwnerDrawer />
        </div>
    </div>
</template>

<style scoped>

</style>
