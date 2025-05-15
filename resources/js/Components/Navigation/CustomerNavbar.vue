<script setup>
import NavLink from "@/Components/NavLink.vue";
import SidebarLink from "@/Components/SidebarLink.vue";
import LogoImageWhite from "@/Components/Logo/LogoImageWhite.vue";
import LogoImage from "@/Components/Logo/LogoImage.vue";
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import {
    UserIcon ,
    ArrowLeftCircleIcon,
    BookmarkIcon,
} from "@heroicons/vue/24/solid";

const page = usePage();

const user = computed(() => page.props.auth.user);

const appName = import.meta.env.VITE_APP_NAME;

const props = defineProps({
    transparent: {
        type: Boolean,
        default: false,
    }
});

const navbarBgClass = computed(() => {
    return props.transparent
        ? 'backdrop-blur-sm'
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
                        :active="route().current('home')"
                        :transparent="transparent"
                    >
                        Home
                    </NavLink>
                </li>
                <li>
                    <NavLink
                        :href="route('gazebo.index')"
                        :active="route().current('gazebo.*')"
                        :transparent="transparent"
                    >
                        Gazebo
                    </NavLink>
                </li>


                <div class="divider divider-horizontal p-0 m-0 mx-2"></div>

                <!-- Right Button -->
                <div class="flex mx-2">
                    <template v-if="user">
                        <!-- Autenticated Button -->
                        <div class="dropdown">
                            <div tabindex="1" role="button" :class="`btn btn-outline hover:btn-info font-black ${navbarButtonClass} capitalize`">
                                <UserIcon class="size-5" />
                                <div :class="navbarButtonTextClass">
                                    {{ (user.name).split(" ")[0] }}
                                </div>
                            </div>
                            <ul tabindex="1"
                                class="menu menu-sm dropdown-content rounded-box z-[1] mt-3 w-40 p-2 bg-base-100 shadow-lg">
                                <li>
                                    <SidebarLink :href="route('profile.edit')" :icon="false">
                                        <template #icon>
                                            <UserIcon class="icon" />
                                        </template>
                                        <template #menu>
                                            Profile
                                        </template>
                                    </SidebarLink>
                                </li>
                                <li>
                                    <SidebarLink href="#">
                                        <template #icon>
                                            <BookmarkIcon class="icon" />
                                        </template>
                                        <template #menu>
                                            Bookings
                                        </template>
                                    </SidebarLink>
                                </li>
                                <div class="divider divider-vertical p-0 m-0"></div>
                                <li>
                                    <SidebarLink :href="route('logout')" method="post">
                                        <template #icon>
                                            <ArrowLeftCircleIcon />
                                        </template>
                                        <template #menu>
                                            Logout
                                        </template>
                                    </SidebarLink>
                                </li>
                            </ul>
                        </div>
                    </template>

                    <template v-else>
                        <!-- Login & Register Button -->
                        <div class="flex">
                            <a :class="`btn btn-outline hover:btn-info font-mono mr-4 ${navbarButtonClass}`"
                               :href="route('login')">
                                <UserIcon class="icon" />
                                <div :class="navbarButtonTextClass">
                                    Log In
                                </div>
                            </a>
                            <a class="btn glass bg-blue-400 hover:bg-amber-400 font-mono font-black text-white"
                               :href="route('register')">
                                Register
                            </a>
                        </div>
                    </template>
                </div>
            </ul>

        </div>
    </div>
</template>

<style scoped>
.icon {
    @apply size-5;
}
</style>
