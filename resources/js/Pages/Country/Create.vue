<script setup>
// Layout
import AdminLayout from '@/Layouts/AdminLayout.vue';
// Components
import TextInput from '@/Components/Input/TextInput.vue';
import Button from '@/Components/Button/Button.vue';
import Label from '@/Components/Label/Label.vue';
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


                <div class="flex justify-end gap-4">
                    <Button type="button" background="bg-gray-500 text-white"
                        hover="hover:bg-gray-600 hover:outline-none hover:ring hover:ring-gray-500" @click="cancel">
                        Cancel
                    </Button>
                    <Button :disabled="form.processing">
                        Save
                    </Button>
                </div>
            </form>
        </template>
    </AdminLayout>
</template>
