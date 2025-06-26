<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import InputError from "@/Components/Input/InputError.vue";
import FileInput from "@/Components/Input/FileInput.vue";
import { ref, computed, watch } from 'vue';
import { Head, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: GuestLayout,
});

const props = defineProps({
    booking: Object,
    errors: Object,
});

const form = useForm({
    image_path: null,
});

const selectedFile = ref(null);

// Handle file selection (for drag-and-drop & click)
const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedFile.value = file;
    }
};

// Handle form submission
const submitForm = () => {
    form.post(route('booking.upload-payment', props.booking.id), {
        forceFormData: true,
        preserveState: true,
        onSuccess: () => {
            form.reset();
        },
        headers: {
            'X-HTTP-Method-Override': 'PATCH',
        }
    });
};
</script>

<template>
    <Head title="Category" />

    <form @submit.prevent="submitForm" class="max-sm:mx-10 md:mx-32 mt-32">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <!-- Upload Box (only visible if checkbox is checked) -->
                    <div class="col-span-full">
                        <InputLabel for="image_path" value="Upload Payment Proof Image" />

                        <FileInput
                            id="image_path"
                            ref="image_path"
                            v-model="form.image_path"
                            @change="handleFileChange"
                        />

                        <InputError :message="errors.image_path" class="mt-2" />
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a type="button" class="text-sm/6 font-semibold text-gray-900" :href="route('booking.detail', booking.id)">Cancel</a>
            <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Save</button>
        </div>
    </form>
</template>

<style scoped>

</style>
