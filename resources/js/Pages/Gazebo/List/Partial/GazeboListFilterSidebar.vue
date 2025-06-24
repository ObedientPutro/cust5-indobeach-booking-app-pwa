<script setup>
import { ref } from 'vue';
import CheckboxInput from "@/Components/Input/CheckboxInput.vue";

const props = defineProps({
    categories: Array,
    amenities: Array,
    initialCategories: Array,
    initialAmenities: Array,
});

const emit = defineEmits(['apply']);

const tempSelectedCategories = ref([...props.initialCategories]);
const tempSelectedAmenities = ref([...props.initialAmenities]);

const apply = () => {
    emit('apply', {
        categories: tempSelectedCategories.value,
        amenities: tempSelectedAmenities.value,
    });
};
</script>

<template>
    <aside class="bg-white p-6 rounded-xl shadow-sm border self-start">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">Filters</h3>

        <!-- Filter Kategori -->
        <div class="border-b border-gray-200 pb-6">
            <h4 class="font-semibold text-gray-800 mb-4">Category</h4>
            <div class="flex flex-wrap gap-2">
                <CheckboxInput
                    v-for="category in categories"
                    :key="category.id"
                    :id="category.id"
                    :name="category.name"
                    v-model:checked="tempSelectedCategories"
                />
            </div>
        </div>

        <!-- Filter Fasilitas Tambahan (Amenities) -->
        <div class="py-6">
            <h4 class="font-semibold text-gray-800 mb-4">Amenities</h4>
            <div class="flex flex-wrap gap-2">
                <CheckboxInput
                    v-for="amenity in amenities"
                    :key="amenity.id"
                    :id="amenity.id"
                    :name="amenity.name"
                    v-model:checked="tempSelectedAmenities"
                />
            </div>
        </div>

        <!-- Tombol Terapkan Filter -->
        <button @click="apply" class="btn btn-info mt-4 w-full text-white">
            Apply Filters
        </button>
    </aside>
</template>

<style scoped>

</style>
