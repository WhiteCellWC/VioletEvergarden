<script setup>
import { computed, ref } from 'vue'

// Props & Emits
const props = defineProps({
    modelValue: {
        type: Array,
        default: () => []
    },
    uploadedImages: {
        type: Array,
        default: () => []
    },
    deleteImages: {
        type: Array,
        default: () => []
    }
})
const emit = defineEmits(['update:modelValue', 'update:deleteImages'])

// Local state
const previews = ref([])
const fileInput = ref(null)

const handleFiles = (files) => {
    const newFiles = Array.from(files)
    previews.value.push(
        ...newFiles.map(file => ({
            file,
            url: URL.createObjectURL(file)
        }))
    )
    emit('update:modelValue', previews.value.map(p => p.file))
}

const onDrop = (e) => {
    e.preventDefault()
    handleFiles(e.dataTransfer.files)
}

const openFileDialog = () => {
    fileInput.value.click()
}

const removeImage = (index) => {
    previews.value.splice(index, 1)
    emit('update:modelValue', previews.value.map(p => p.file))
}

const deleteImage = (imageId) => {
    const current = props.deleteImages || [];
    const updated = [...current, imageId];
    emit('update:deleteImages', updated);
};

const shownImages = computed(() => {
    if (props.deleteImages?.length > 0) {
        return props.uploadedImages.filter(
            img => !props.deleteImages.includes(img.id)
        )
    } else {
        return props.uploadedImages
    }
})
</script>

<template>
    <div class="flex flex-col gap-4">
        <!-- Dropzone -->
        <div class="border-2 border-dashed border-gray-400 dark:border-gray-600 rounded-lg min-h-[20svh] cursor-pointer hover:border-[var(--primary-50)]
         flex items-center justify-center p-8" @click="openFileDialog" @dragover.prevent @drop="onDrop">
            <p class="text-gray-500 dark:text-gray-400 text-sm text-center">
                Drag & drop an image here, or
                <span class="text-[var(--primary-50)] underline"> click to select</span>
            </p>

            <input type="file" accept="image/*" multiple class="hidden" ref="fileInput"
                @change="e => handleFiles(e.target.files)" />
        </div>

        <!-- Previews -->
        <div class="flex flex-wrap gap-4">
            <div v-for="(img, index) in previews" :key="index"
                class="relative w-28 h-28 border rounded overflow-hidden">
                <img :src="img.url" alt="preview" class="w-full h-full object-cover" />
                <button type="button" @click="removeImage(index)"
                    class="absolute top-0 right-0 bg-red-600 text-white px-1 text-xs">
                    ✕
                </button>
            </div>
            <div v-for="img in shownImages" :key="`uploaded-image-${img.id}`"
                class="relative w-28 h-28 border rounded overflow-hidden">
                <img :src="img.image_path" alt="preview" class="w-full h-full object-cover" />
                <button type="button" @click="deleteImage(img.id)"
                    class="absolute top-0 right-0 bg-red-600 text-white px-1 text-xs">
                    ✕
                </button>
            </div>
        </div>
    </div>
</template>
