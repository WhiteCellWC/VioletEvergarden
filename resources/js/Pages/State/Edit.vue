<script setup>
// Layout
import AdminLayout from '@/Layouts/AdminLayout.vue';
// Components
import TextInput from '@/Components/Input/TextInput.vue';
import Label from '@/Components/Label/Label.vue';
import Dropdown from '@/Components/Dropdown/Dropdown.vue';
import Button from '@/Components/Button/Button.vue';
//Libs
import { ref } from 'vue';
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    'state': {
        type: Object,
        required: true,
        default: () => ({})
    }
})
// Ref
const form = useForm({
    name: props.state.data.name,
    country_id: props.state.data.country_id
})
const modelLabel = ref(props.state.data.country.name);

// Handlers
const submit = () => {
    form.put(route('states.update', { state: props.state.data.id }))
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
                    <h2 class="text-xl font-bold">States</h2>
                </div>
            </div>

            <form @submit.prevent="submit" class="p-8 flex flex-col w-1/2 gap-6">
                <div class="flex flex-col gap-2">
                    <Label for="name" mandatory>State</Label>
                    <TextInput id="name" placeholder="Input Name" v-model="form.name" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="country_id" mandatory>Country</Label>
                    <Dropdown v-model="form.country_id" v-model:modelLabel="modelLabel"
                        :fetchRoute="route('api.v1.countries.index')" :valueKey="'id'" :labelKey="'name'"
                        placeholder="Select Country" :allowSearch="true" />
                </div>

                <div class="flex justify-end gap-4">
                    <Button type="button" background="bg-gray-500 text-white"
                        hover="hover:bg-gray-600 hover:outline-none hover:ring hover:ring-gray-500" @click="cancel">
                        Cancel
                    </Button>
                    <Button :disabled="form.processing">
                        Update
                    </Button>
                </div>
            </form>
        </template>
    </AdminLayout>
</template>
