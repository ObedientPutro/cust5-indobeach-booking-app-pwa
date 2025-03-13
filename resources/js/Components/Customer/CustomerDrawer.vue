<script setup>
import { ref, onMounted, onUnmounted, watch, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";

const activeSection = ref(null);
const isRouteActive = ref(null);
const page = usePage();

// Function to update active section based on scroll position
const updateActiveSection = () => {
    const sections = ['#home', '#features', '#about', '#contact'];

    for (const section of sections) {
        const el = document.querySelector(section);
        if (el) {
            isRouteActive.value = null;
            const rect = el.getBoundingClientRect();
            if (rect.top <= 350 && rect.bottom >= 350) {
                activeSection.value = section;
                break;
            }
        }
    }
};

const updateIsRouteActive = () => {
    const routePaths = [
        route('home', {}, false),
        route('login', {}, false),
        // route('search', {}, false),
        // route('product', {}, false),
    ];
    isRouteActive.value = routePaths.includes(page.url) ? page.url : null;
}

// Watch for page URL changes (for route-based links)
watch(() => page.url, () => {
    if (isRouteActive.value) {
        activeSection.value = null; // Reset active section when navigating to another page
    }
});

onMounted(() => {
    updateIsRouteActive();
    window.addEventListener('scroll', updateActiveSection);
});

onUnmounted(() => {
    window.removeEventListener('scroll', updateActiveSection);
});
</script>

<template>
    <div class="drawer-side z-20">
        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-full w-60 p-4">
            <!-- Sidebar content here -->
            <li>
                <NavLink :href="route('home')" :active="(isRouteActive === route('home', {}, false)) || (!isRouteActive && activeSection === '#home')">
                    Beranda
                </NavLink>
            </li>
            <li>
                <NavLink :href="route('home') + '#features'" :active="!isRouteActive && activeSection === '#features'">
                    Fitur
                </NavLink>
            </li>
            <li>
                <NavLink :href="route('home') + '#about'" :active="!isRouteActive && activeSection === '#about'">
                    Tentang
                </NavLink>
            </li>
            <li>
                <NavLink :href="route('home') + '#contact'" :active="!isRouteActive && activeSection === '#contact'">
                    Kontak
                </NavLink>
            </li>
<!--            <li>-->
<!--                <NavLink :href="route('search')" :active="isRouteActive === route('search', {}, false)">-->
<!--                    Pencarian-->
<!--                </NavLink>-->
<!--            </li>-->
<!--            <li>-->
<!--                <NavLink :href="route('product')" :active="isRouteActive === route('product', {}, false)">-->
<!--                    Produk-->
<!--                </NavLink>-->
<!--            </li>-->
            <div class="divider divider-vertical"></div>
            <li class="pt-2">
                <div>
                    <font-awesome-icon icon="fa-solid fa-user" />
                    Johnson
                </div>
                <ul class="p-2">
                    <li><a class="font-bold">Profile</a></li>
                    <li><a class="font-bold">Booking Histories</a></li>
                    <li><a class="font-bold">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<style scoped>

</style>
