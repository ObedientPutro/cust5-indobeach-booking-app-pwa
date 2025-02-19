<script setup>

</script>

<template>
    <div class="drawer-side">
        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-full w-80 p-4">
            <li><a :href="route('home')" class="font-bold text-base">Home</a></li>
            <li><a class="font-bold text-base">About</a></li>
            <li><a class="font-bold text-base">Gallery</a></li>
            <li><a class="font-bold text-base">Contact</a></li>
            <li><a class="font-bold text-base">Cottage</a></li>
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
