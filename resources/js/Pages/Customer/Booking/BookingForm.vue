<script setup>
import { useForm, router } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    gazebo: Object, // { id: 1, name: 'Gazebo Type 1', ... }
})

const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
    start_date: '',
    end_date: '',
    gazebo_id: props.gazebo.id,
})

const gazeboName = computed(() => props.gazebo.name)

function goBack() {
    router.visit('/gazebos') // Adjust route as needed
}

function submitBooking() {
    form.post('/bookings', {
        onSuccess: () => {
            router.visit(`/gazebos/${props.gazebo.id}`) // back to detail page
        }
    })
}
</script>

<template>
    <div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">
            Booking for {{ gazeboName }}
        </h2>

        <form @submit.prevent="submitBooking">
            <div class="space-y-4">
                <div>
                    <label class="block font-semibold">Name</label>
                    <input v-model="form.name" type="text" class="w-full input" required />
                </div>

                <div>
                    <label class="block font-semibold">Email</label>
                    <input v-model="form.email" type="email" class="w-full input" required />
                </div>

                <div>
                    <label class="block font-semibold">Phone Number</label>
                    <input v-model="form.phone" type="text" class="w-full input" required />
                </div>

                <div>
                    <label class="block font-semibold">Address</label>
                    <textarea v-model="form.address" class="w-full input" rows="3" required></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold">Start Date</label>
                        <input v-model="form.start_date" type="date" class="w-full input" required />
                    </div>

                    <div>
                        <label class="block font-semibold">End Date</label>
                        <input v-model="form.end_date" type="date" class="w-full input" required />
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" @click="goBack" class="btn bg-gray-200">Back to List</button>
                    <button type="submit" class="btn bg-green-600 text-white">Submit Booking</button>
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
