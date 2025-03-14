<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import OwnerLayout from "@/Layouts/OwnerLayout.vue";
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from "vue";

const page = usePage();

const user = computed(() => page.props.auth.user);

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <template v-if="user.role === 'owner'">
        <OwnerLayout>
            <div class="px-2 mt-2">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>
            <div class="divider divider-vertical w-full mx-auto"></div>
            <div class="px-2 mt-10 mb-3">
                <UpdatePasswordForm class="max-w-xl" />
            </div>
        </OwnerLayout>
    </template>

    <template v-else>
        <GuestLayout>
            <div class="py-12 mt-20">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </div>
            </div>
        </GuestLayout>
    </template>


</template>
