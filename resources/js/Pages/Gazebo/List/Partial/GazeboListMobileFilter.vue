<script setup>
import { ref, watch } from 'vue';
import CheckboxInput from "@/Components/Input/CheckboxInput.vue";

const props = defineProps({
    show: Boolean,
    categories: Array,
    amenities: Array,
    initialCategories: Array,
    initialAmenities: Array,
});

const emit = defineEmits(['close', 'apply']);

const tempSelectedCategories = ref([]);
const tempSelectedAmenities = ref([]);

watch(() => props.show, (newValue) => {
    if (newValue) {
        tempSelectedCategories.value = [...props.initialCategories];
        tempSelectedAmenities.value = [...props.initialAmenities];
    }
});

const apply = () => {
    emit('apply', {
        categories: tempSelectedCategories.value,
        amenities: tempSelectedAmenities.value,
    });
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-end sm:items-center justify-center" @click.self="emit('close')">
        <div class="fixed inset-0 bg-black/50" aria-hidden="true"></div>
        <div class="relative bg-white w-full max-w-lg p-6 rounded-t-xl sm:rounded-xl m-4" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <h3 id="modal-headline" class="text-xl font-semibold text-gray-900 mb-6">Filters</h3>

            <div class="space-y-6">
                <!-- Filter Kategori -->
                <div>
                    <h4 class="font-semibold text-gray-800 mb-4">Category</h4>
                    <div class="flex flex-wrap gap-2">
                        <CheckboxInput
                            v-for="category in categories"
                            :key="`mobile-cat-${category.id}`"
                            :id="category.id"
                            :name="category.name"
                            v-model:checked="tempSelectedCategories"
                        />
                    </div>
                </div>

                <!-- Filter Fasilitas Tambahan -->
                <div>
                    <h4 class="font-semibold text-gray-800 mb-4">Amenities</h4>
                    <div class="flex flex-wrap gap-2">
                        <CheckboxInput
                            v-for="amenity in amenities"
                            :key="`mobile-amenity-${amenity.id}`"
                            :id="amenity.id"
                            :name="amenity.name"
                            v-model:checked="tempSelectedAmenities"
                        />
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex justify-end gap-3">
                <button @click="emit('close')" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                    Cancel
                </button>
                <button @click="apply" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Apply Filter
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
