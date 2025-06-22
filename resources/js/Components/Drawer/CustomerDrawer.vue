<script setup>
import { ref, onMounted, onUnmounted, watch, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
import {
    UserIcon,
} from "@heroicons/vue/24/solid";

const activeSection = ref(null);
const isRouteActive = ref(null);
const page = usePage();
const user = computed(() => page.props.auth.user);

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
                <NavLink
                    :href="route('home')"
                    :active="route().current('home')"
                >
                    Home
                </NavLink>
            </li>
            <li>
                <NavLink
                    :href="route('gazebo.index')"
                    :active="route().current('gazebo.*')"
                >
                    Gazebo
                </NavLink>
            </li>
            <div class="divider divider-vertical"></div>
            <li v-if="user" class="pt-2">
                <div class="capitalize">
                    <UserIcon class="icon" />
                    {{ user.name }}
                </div>
                <ul class="p-2">
                    <li>
                        <div class="py-0 px-1">
                            <NavLink
                                :href="route('profile.edit')"
                                :active="route().current('profile.*')"
                            >
                                Profile
                            </NavLink>
                        </div>
                    </li>
                    <li>
                        <div class="py-0 px-1">
                            <NavLink
                                :href="route('booking')"
                                :active="route().current('booking')"
                            >
                                Booking History
                            </NavLink>
                        </div>
                    </li>
                    <li>
                        <div class="py-0 px-1">
                            <NavLink
                                :href="route('logout')"
                                method="post"
                            >
                                Logout
                            </NavLink>
                        </div>
                    </li>
                </ul>
            </li>
            <div v-else>
                <li>
                    <NavLink
                        :href="route('login')"
                        :active="route().current('login')"
                    >
                        Login
                    </NavLink>
                </li>
                <li>
                    <NavLink
                        :href="route('register')"
                        :active="route().current('register')"
                    >
                        Register
                    </NavLink>
                </li>
            </div>
        </ul>
    </div>
</template>

<style scoped>
.icon {
    @apply size-5;
}
</style>
