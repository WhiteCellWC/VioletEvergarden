<script setup>
// Layout
import AdminLayout from '@/Layouts/AdminLayout.vue';
// Components
import TextInput from '@/Components/Input/TextInput.vue';
import Label from '@/Components/Label/Label.vue';
import Dropdown from '@/Components/Dropdown/Dropdown.vue';
//Libs
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';

// Ref
const form = useForm({
    name: '',
    iso_code: '',
    phone_code: ''
})

// Handlers
const submit = () => {
    form.post(route('countries.store'))
}

const cancel = () => {
    form.reset()
    history.back()
}
</script>

<template>
    <AdminLayout>
        <template #content>
            <div class="px-4 py-2 bg-gray-600">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold">Country</h2>
                </div>
            </div>

            <form @submit.prevent="submit" class="p-8 flex flex-col w-1/2 gap-6">
                <div class="flex flex-col gap-2">
                    <Label for="name" mandatory>Country</Label>
                    <TextInput id="name" placeholder="Input Name" v-model="form.name" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="iso_code" mandatory>ISO</Label>
                    <TextInput id="iso_code" placeholder="Input Code" v-model="form.iso_code" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="phone_code" mandatory>Phone</Label>
                    <TextInput id="phone_code" placeholder="Input Code" v-model="form.phone_code" />
                </div>


                <div class="flex gap-4">
                    <button type="button" @click="cancel"
                        class="px-4 py-2 rounded-md bg-gray-500 text-white hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" :disabled="form.processing"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </template>
    </AdminLayout>
</template>
