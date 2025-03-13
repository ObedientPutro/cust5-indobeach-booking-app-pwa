<script setup>
import NavLink from "@/Components/NavLink.vue";
import LogoImageWhite from "@/Components/LogoImage/LogoImageWhite.vue";
import { ref, onMounted, onUnmounted, watch, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import LogoImage from "@/Components/LogoImage/LogoImage.vue";

const activeSection = ref(null);
const isRouteActive = ref(null);
const page = usePage();

const appName = import.meta.env.VITE_APP_NAME;

const props = defineProps({
    transparent: {
        type: Boolean,
        default: false,
    }
});

// Function to update active section based on scroll position
const updateActiveSection = () => {
    const sections = ['#home', '#gallery', '#about', '#contact'];

    for (const section of sections) {
        const el = document.querySelector(section);
        if (el) {
            isRouteActive.value = null;
            const rect = el.getBoundingClientRect();
            if (rect.top <= 150 && rect.bottom >= 150) {
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
    ];
    isRouteActive.value = routePaths.includes(page.url) ? page.url : null;
}

const navbarBgClass = computed(() => {
    return props.transparent
        ? 'backdrop-blur-sm '
        : 'bg-white';
});

const navbarTitleClass = computed(() => {
    return props.transparent
        ? 'text-white'
        : 'text-black';
});

const navbarButtonClass = computed(() => {
    return props.transparent
        ? 'text-white'
        : 'text-blue-400';
});

const navbarButtonTextClass = computed(() => {
    return props.transparent
        ? 'text-white'
        : 'text-black';
});

// Watch for page URL changes (for route-based links)
watch(() => page.url, () => {
    if (isRouteActive.value) {
        activeSection.value = null;
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
    <div :class="`navbar shadow-lg px-8 fixed top-0 w-full z-10 transition-all duration-300 ease-in-out ${navbarBgClass}`">

        <!-- Drawer Logo -->
        <div :class="`flex-none lg:hidden ${navbarTitleClass}`">
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
                    <LogoImageWhite v-if="transparent" />
                    <LogoImage v-else />
                </div>
            </div>
            <div class="visible">
                <a :class="`ml-3 lg:text-xl uppercase font-black font-mono ${navbarTitleClass}`">{{ appName }}</a>
            </div>
        </div>

        <div class="hidden flex-none lg:block">
            <ul class="menu menu-horizontal space-x-4">
                <!-- Navbar menu content here -->
                <li>
                    <NavLink
                        :href="route('home')"
                        :active="(isRouteActive === route('home', {}, false)) || (!isRouteActive && activeSection === '#home')"
                        :transparent="transparent"
                    >
                        Home
                    </NavLink>
                </li>
                <li>
                    <NavLink
                        :href="route('home') + '#gallery'"
                        :active="!isRouteActive && activeSection === '#gallery'"
                        :transparent="transparent"
                    >
                        Gallery
                    </NavLink>
                </li>
                <li>
                    <NavLink
                        :href="route('home') + '#about'"
                        :active="!isRouteActive && activeSection === '#about'"
                        :transparent="transparent"
                    >
                        About
                    </NavLink>
                </li>
                <li>
                    <NavLink
                        :href="route('home') + '#contact'"
                        :active="!isRouteActive && activeSection === '#contact'"
                        :transparent="transparent"
                    >
                        Contact
                    </NavLink>
                </li>
                <li>
                    <NavLink
                        href="#"
                        :transparent="transparent"
                    >
                        Gazebo
                    </NavLink>
                </li>
<!--                <li>-->
<!--                    <NavLink :href="route('product')" :active="isRouteActive === route('product', {}, false)">-->
<!--                        Produk-->
<!--                    </NavLink>-->
<!--                </li>-->

                <div class="divider divider-horizontal p-0 m-0 mx-2"></div>

                <!-- Button Right Side -->
                <div class="flex mx-2">
                    <!-- Profile Button -->
                    <div class="hidden">
                        <div class="dropdown">
                            <div tabindex="1" role="button" class="btn btn-outline hover:btn-info font-black text-white">
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
                        <a :class="`btn btn-outline hover:btn-info font-mono mr-4 ${navbarButtonClass}`"
                           @click="$emit('open-login-modal')">
                            <font-awesome-icon icon="fa-solid fa-user" />
                            <div :class="navbarButtonTextClass">
                                Log In
                            </div>
                        </a>
                        <a class="btn glass bg-blue-400 hover:bg-amber-400 font-mono font-black text-white"
                           @click="$emit('open-register-modal')">
                            Register
                        </a>
                    </div>
                </div>
            </ul>

        </div>
    </div>
</template>

<style scoped>

</style>
