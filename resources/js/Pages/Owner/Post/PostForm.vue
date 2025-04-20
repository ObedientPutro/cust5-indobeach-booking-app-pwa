<script setup>
import OwnerLayout from "@/Layouts/OwnerLayout.vue";
import CheckboxInput from "@/Components/Input/CheckboxInput.vue";
import TextInput from "@/Components/Input/TextInput.vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import InputError from "@/Components/Input/InputError.vue";
import FileInput from "@/Components/Input/FileInput.vue";
import TextareaInput from "@/Components/Input/TextareaInput.vue";
import SelectInput from "@/Components/Input/SelectInput.vue";
import NumberInput from "@/Components/Input/NumberInput.vue";
import { ref, watch, onMounted } from 'vue';
import {Head, useForm} from "@inertiajs/vue3";

defineOptions({
    layout: OwnerLayout
});

const props = defineProps({
    post: Object,
    categories: Object,
    amenities: Object,
    statuses: Object,
    errors: Object,
});

console.log(props.post);

const form = useForm({
    category_id: props.post?.category_id || "",
    title: props.post?.title || "",
    description: props.post?.description || "",
    price: props.post?.price || 0,
    quantity: props.post?.quantity || 0,
    status: props.post?.status || '',
    selected_amenities: [],
    images: [],
});

const selectedImages = ref([]);

onMounted(() => {
    // Preload existing images if available
    if (props.post?.images) {
        selectedImages.value = props.post.images.map((img) => ({
            file: false,
            url: `/storage/${img.image_path}`,
            image_path: img.image_path,
        }));
    }

    // Pre-select amenities if available
    if (props.post?.amenities) {
        form.selected_amenities = props.post.amenities.map((amenity) => amenity.id);
    }
});

watch(selectedImages, () => {
    form.images = selectedImages.value.map((img) =>
        img.file ? img.fileObject : img.image_path
    );
});

const toggleAmenity = (id) => {
    if (form.selected_amenities.includes(id)) {
        form.selected_amenities = form.selected_amenities.filter(item => item !== id);
    } else {
        form.selected_amenities.push(id);
    }
};

const handleImageUpload = (event) => {
    const files = Array.from(event.target.files);
    files.forEach((file) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            selectedImages.value.push({
                file: true,
                url: e.target.result,
                fileObject: file,
            });
        };
        reader.readAsDataURL(file);
    });
    event.target.value = "";
};

const removeImage = (index) => {
    selectedImages.value.splice(index, 1);
};

const submitForm = () => {
    const url = props.post
        ? route("admin.post.update", props.post.id)
        : route("admin.post.save");

    form.images = [];

    selectedImages.value.forEach((img) => {
        if (img.file) {
            form.images.push(img.fileObject); // Push the file object directly
        } else {
            form.images.push(img.image_path); // Push the existing image path
        }
    });

    form.post(url, {
        forceFormData: true,
        preserveState: true,
        onSuccess: () => {
            form.reset();
            selectedImages.value = [];
        },
        headers: {
            'X-HTTP-Method-Override': props.post ? 'PATCH' : 'POST',
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

                    <!-- Title Input -->
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                ref="title"
                                v-model="form.title"
                                type="text"
                                class="mt-1 block w-full capitalize"
                                placeholder="Enter title"
                            />

                            <InputError :message="errors.title" class="mt-2" />

                        </div>
                    </div>

                    <!-- Category Input -->
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="category" value="Category" />

                            <SelectInput class="capitalize"
                                         v-model="form.category_id"
                                         :items="categories"
                                         placeholder="Choose an option"
                            />

                            <InputError :message="errors.category_id" class="mt-2" />
                        </div>
                    </div>

                    <!-- Price Input -->
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="price" value="Price" />

                            <NumberInput
                                id="price"
                                ref="price"
                                v-model="form.price"
                                type="number"
                                class="mt-1 block w-full"
                                placeholder="Enter price without comma or dot"
                            />

                            <InputError :message="errors.price" class="mt-2" />

                        </div>
                    </div>

                    <!-- Quantity Input -->
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="quantity" value="Quantity" />

                            <NumberInput
                                id="quantity"
                                ref="quantity"
                                v-model="form.quantity"
                                type="number"
                                class="mt-1 block w-full"
                                placeholder="Enter quantity without comma or dot"
                            />

                            <InputError :message="errors.quantity" class="mt-2" />

                        </div>
                    </div>

                    <!-- Description Input -->
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="description" value="Description" />

                            <TextareaInput
                                id="description"
                                ref="description"
                                v-model="form.description"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="Enter a description"
                            />

                            <InputError :message="errors.description" class="mt-2" />

                        </div>
                    </div>

                    <!-- Image Container with Horizontal Scroll -->
                    <div class="col-span-full overflow-x-auto whitespace-nowrap flex gap-4 mt-5">
                        <div v-for="(image, index) in selectedImages" :key="index" class="relative">
                            <img :src="image.file ? image.url : `/storage/${image.image_path}`"
                                 alt="Preview"
                                 class="w-24 h-24 object-cover rounded-md border shadow-md"
                            />
                            <button type="button"
                                    @click="removeImage(index)"
                                    class="absolute top-0 right-0 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center shadow-md hover:bg-red-500">
                                ×
                            </button>
                            <p class="text-sm text-center mt-2">Order: {{ index + 1 }}</p>
                        </div>
                    </div>

                    <!-- Upload Box -->
                    <div class="col-span-full">
                        <InputLabel for="images" value="Upload Image" />

                        <FileInput
                            id="images"
                            ref="images"
                            @change="handleImageUpload"
                            multiple
                        />

                        <InputError :message="errors.images" class="mt-2" />
                    </div>

                    <!-- Amenities Checkbox Container -->
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="selected_amenities" value="Amenities" />

                            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                                <CheckboxInput
                                    v-for="amenity in amenities"
                                    :id="amenity.id"
                                    :key="amenity.id"
                                    :value="amenity.id"
                                    :name="amenity.name"
                                    :checked="form.selected_amenities.includes(amenity.id)"
                                    @update:checked="toggleAmenity(amenity.id)"
                                />
                            </div>

                            <InputError :message="errors.selected_amenities" class="mt-2" />
                        </div>
                    </div>

                    <!-- Status Input -->
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="status" value="Status" />

                            <SelectInput class="capitalize"
                                         v-model="form.status"
                                         :items="statuses"
                                         placeholder="Choose an option"
                            />

                            <InputError :message="errors.status" class="mt-2" />
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a type="button" class="text-sm/6 font-semibold text-gray-900" :href="route('admin.post.index')">Cancel</a>
            <button type="submit" class="rounded-md bg-blue-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Save</button>
        </div>
    </form>
</template>

<style scoped>
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1; /* Tailwind slate-300 */
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9; /* Tailwind slate-100 */
}
</style>
