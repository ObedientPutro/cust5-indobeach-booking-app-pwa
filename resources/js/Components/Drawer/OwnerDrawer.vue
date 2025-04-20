<script setup>
import SidebarLink from "@/Components/SidebarLink.vue";
import {
    ArchiveBoxIcon,
    UserIcon ,
    ArrowLeftCircleIcon,
    DocumentIcon,
    DevicePhoneMobileIcon,
    BookmarkIcon,
    HomeIcon
} from "@heroicons/vue/24/solid";

const appName = import.meta.env.VITE_APP_NAME;
</script>

<template>
    <aside class="w-64 bg-white shadow-md h-full flex flex-col justify-between">
        <div class="p-4">
            <div class="flex text-center px-3.5 py-2">
                <span class="text-blue-500 font-black uppercase">{{ appName }}</span>
            </div>

            <!-- Menu Items -->
            <ul class="menu p-0 mt-5">
                <li>
                    <SidebarLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                        <template #icon>
                            <HomeIcon class="icon" />
                        </template>
                        <template #menu>
                            Dashboard
                        </template>
                    </SidebarLink>
                </li>
                <li>
                    <SidebarLink :href="route('admin.post.index')" :active="route().current('admin.post.*')">
                        <template #icon>
                            <DevicePhoneMobileIcon class="icon" />
                        </template>
                        <template #menu>
                            Posts
                        </template>
                    </SidebarLink>
                </li>
                <li>
                    <SidebarLink :href="route('admin.category.index')" :active="route().current('admin.category.*')">
                        <template #icon>
                            <BookmarkIcon class="icon" />
                        </template>
                        <template #menu>
                            Categories
                        </template>
                    </SidebarLink>
                </li>
                <li>
                    <SidebarLink :href="route('admin.amenity.index')" :active="route().current('admin.amenity.*')">
                        <template #icon>
                            <ArchiveBoxIcon class="icon" />
                        </template>
                        <template #menu>
                            Amenities
                        </template>
                    </SidebarLink>
                </li>
                <li>
                    <SidebarLink :href="route('admin.booking.index')" :active="route().current('admin.booking.*')">
                        <template #icon>
                            <DocumentIcon class="icon" />
                        </template>
                        <template #menu>
                            Bookings
                        </template>
                    </SidebarLink>
                </li>
            </ul>
            <div class="divider divider-vertical w-4/5 mx-auto"></div>
            <ul class="menu p-0menu p-0">
                <li>
                    <SidebarLink :href="route('profile.edit')" :active="route().current('profile.*')">
                        <template #icon>
                            <UserIcon class="icon" />
                        </template>
                        <template #menu>
                            Profile
                        </template>
                    </SidebarLink>
                </li>
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
    </aside>
</template>

<style scoped>

</style>
