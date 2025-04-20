<script setup>
import OwnerLayout from "@/Layouts/OwnerLayout.vue";
import CheckboxInput from "@/Components/Input/CheckboxInput.vue";
import TextInput from "@/Components/Input/TextInput.vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import InputError from "@/Components/Input/InputError.vue";
import FileInput from "@/Components/Input/FileInput.vue";
import { ref, computed, watch } from 'vue';
import { UserCircleIcon } from '@heroicons/vue/24/solid';
import {Head, useForm} from "@inertiajs/vue3";

defineOptions({
    layout: OwnerLayout,
});

const props = defineProps({
    category: Object,
    errors: Object,
});

const form = useForm({
    name: props.category?.name || "",
    icon_path: null,
});

const selectedFile = ref(null);
const iconPreview = ref(props.category?.icon_path || null);
const isEditingIcon = ref(!iconPreview.value);

const iconSrc = computed(() => {
    return selectedFile.value ? iconPreview.value : `/${iconPreview.value}`;
});

// Handle file selection (for drag-and-drop & click)
const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedFile.value = file;
        iconPreview.value = URL.createObjectURL(file);
    }
};

watch(iconPreview, (newVal) => {
    if (!newVal) isEditingIcon.value = true;
});

// Handle form submission
const submitForm = () => {
    const url = props.category
        ? route("admin.category.update", props.category.id)
        : route("admin.category.save");

    form.post(url, {
        forceFormData: true,
        preserveState: true,
        onSuccess: () => {
            form.reset();
        },
        headers: {
            'X-HTTP-Method-Override': props.category ? 'PATCH' : 'POST',
        }
    });
};
</script>

<template>
    <Head title="Category" />

    <form @submit.prevent="submitForm" class="mx-2">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <!-- Name Input -->
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                ref="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full capitalize"
                                placeholder="Enter category name"
                            />

                            <InputError :message="errors.name" class="mt-2" />

                        </div>
                    </div>

                    <!-- Icon Preview & Checkbox -->
                    <div class="col-span-full">
                        <label class="block text-sm font-medium text-gray-900">Category Icon</label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <!-- Show current image if available -->
                            <img
                                v-if="iconPreview && selectedFile"
                                :src="iconSrc"
                                alt="Category Icon"
                                class="size-12 rounded-md"
                            />
                            <img
                                v-else-if="iconPreview && !selectedFile"
                                :src="`/storage/${iconSrc}`"
                                alt="Category Icon"
                                class="size-12 rounded-md"
                            />
                            <UserCircleIcon v-else class="size-12 text-gray-300" />

                            <!-- Checkbox to toggle file upload -->
                            <CheckboxInput
                                :id="1"
                                name="Change"
                                v-model:checked="isEditingIcon"
                                :value="'edit-icon'"
                                :disabled="!iconPreview"
                            >
                                Change
                            </CheckboxInput>
                        </div>
                    </div>

                    <!-- Upload Box (only visible if checkbox is checked) -->
                    <div v-if="isEditingIcon" class="col-span-full">
                        <InputLabel for="icon_path" value="Upload Icon" />

                        <FileInput
                            id="icon_path"
                            ref="icon_path"
                            v-model="form.icon_path"
                            @change="handleFileChange"
                        />

                        <InputError :message="errors.icon_path" class="mt-2" />
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a type="button" class="text-sm/6 font-semibold text-gray-900" :href="route('admin.category.index')">Cancel</a>
            <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Save</button>
        </div>
    </form>
</template>

<style scoped>

</style>
