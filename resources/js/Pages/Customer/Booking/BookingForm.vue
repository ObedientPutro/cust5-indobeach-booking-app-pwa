<script setup>
import { useForm, router, usePage } from '@inertiajs/vue3'
import { defineOptions, computed } from 'vue'
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import TextInput from "@/Components/Input/TextInput.vue";
import TextareaInput from "@/Components/Input/TextareaInput.vue";
import InputError from "@/Components/Input/InputError.vue";

defineOptions({
    layout: GuestLayout,
})

const props = defineProps({
    post: Object,
})

const user = usePage().props.auth.user;

const form = useForm({
    start_date: '',
    end_date: '',
})

const postName = computed(() => props.post.title)

const duration = computed(() => {
    if (!form.start_date || !form.end_date) return 0;

    const start = new Date(form.start_date);
    const end = new Date(form.end_date);
    const diff = (end - start) / (1000 * 60 * 60 * 24) + 1;

    return diff > 0 ? diff : 0;
});

const totalPrice = computed(() => {
    return props.post.price * duration.value;
});

function submitBooking() {
    form.post(route('booking.store', props.post.id), {
        onSuccess: () => {
            form.reset();
        }
    })
}
</script>

<template>
    <div class="my-32 max-w-xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4 capitalize">
            Booking for {{ postName }}
        </h2>

        <form @submit.prevent="submitBooking">
            <div class="space-y-4">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full capitalize"
                        v-model="user.name"
                        required
                        autofocus
                        autocomplete="name"
                        disabled="disabled"
                    />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="user.email"
                        required
                        autofocus
                        autocomplete="email"
                        disabled="disabled"
                    />
                </div>

                <div>
                    <InputLabel for="phone_number" value="Phone Number" />

                    <TextInput
                        id="phone_number"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="user.phone_number"
                        required
                        autofocus
                        autocomplete="phone_number"
                        disabled="disabled"
                    />
                </div>

                <div>
                    <InputLabel for="address" value="Address" />

                    <TextareaInput
                        id="address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="user.address"
                        required
                        autofocus
                        autocomplete="address"
                        disabled="disabled"
                    />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold">Start Date</label>
                        <input v-model="form.start_date" type="date" class="w-full input" required />
                        <InputError class="mt-2" :message="form.errors.start_date" />
                    </div>

                    <div>
                        <label class="block font-semibold">End Date</label>
                        <input v-model="form.end_date" type="date" class="w-full input" required />
                        <InputError class="mt-2" :message="form.errors.end_date" />
                    </div>
                </div>

                <p v-if="duration" class="mt-4 text-green-600">
                    Booking for {{ duration }} day(s) — Total: {{ $formatRupiah(totalPrice) }}
                </p>

                <div class="flex justify-between mt-6">
                    <a  class="btn btn-error text-white"
                        :href="route('gazebo.detail', props.post.id)"
                    >Cancel</a>
                    <button type="submit" class="btn btn-success text-white">Submit Booking</button>
                </div>
            </div>
        </form>
    </div>
</template>

<style scoped>
.input {
    @apply border rounded px-3 py-2 w-full;
}
.btn {
    @apply px-4 py-2 rounded;
}
</style>
