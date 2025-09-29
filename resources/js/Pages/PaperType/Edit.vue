<script setup>
// Layout
import AdminLayout from '@/Layouts/AdminLayout.vue';
// Components
import TextInput from '@/Components/Input/TextInput.vue';
import TextAreaInput from '@/Components/Input/TextAreaInput.vue';
import NumberInput from '@/Components/Input/NumberInput.vue';
import ToggleInput from '@/Components/Input/ToggleInput.vue';
import ImageMultipleInput from '@/Components/Input/ImageMultipleInput.vue';
import Button from '@/Components/Button/Button.vue';
import Label from '@/Components/Label/Label.vue';
//Libs
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';

// Props
const props = defineProps({
    'paperType': {
        type: Object,
        required: true,
        default: () => ({})
    }
});

// Ref
const form = useForm({
    _method: 'PUT',
    name: props.paperType.data.name,
    description: props.paperType.data.description,
    price_per_page: props.paperType.data.price_per_page,
    stock: props.paperType.data.stock,
    discount: props.paperType.data.discount,
    images: [],
    delete_images: [],
    is_premium: props.paperType.data.is_premium,
    status: props.paperType.data.status
})

// Handlers
const submit = () => {
    form.post(route('paper-types.update', { paper_type: props.paperType.data.id }))
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
                    <h2 class="text-xl font-bold">Paper Type</h2>
                </div>
            </div>

            <form @submit.prevent="submit" class="p-8 flex flex-col w-1/2 gap-6">
                <div class="flex flex-col gap-2">
                    <Label for="name" mandatory>Paper Name</Label>
                    <TextInput id="name" placeholder="Input Name" v-model="form.name" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="description" mandatory>Description</Label>
                    <TextAreaInput id="description" placeholder="Input Description" v-model="form.description" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="price_per_page" mandatory>Price Per Page</Label>
                    <NumberInput id="price_per_page" placeholder="Input Price" v-model="form.price_per_page" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="stock" mandatory>Stock</Label>
                    <NumberInput id="stock" placeholder="Input Stock" v-model="form.stock" :min="0" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="discount">Discount</Label>
                    <NumberInput id="discount" placeholder="Input Discount" v-model="form.discount" :min="1"
                        :max="100" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label mandatory>Image</Label>
                    <ImageMultipleInput v-model="form.images" :uploadedImages="paperType.data.images"
                        v-model:deleteImages="form.delete_images" />
                </div>

                <ToggleInput v-model="form.is_premium" label="Is Premium" />

                <ToggleInput v-model="form.status" label="Status" />

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
