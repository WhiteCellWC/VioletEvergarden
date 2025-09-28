<script setup>
import { ref } from "vue";

const file = ref(null);
const preview = ref(null);

// Emits
const emit = defineEmits(["update:modelValue"]);

const onFileChange = (event) => {
    const selectedFile = event.target.files[0];
    if (selectedFile && selectedFile.type.startsWith("image/")) {
        file.value = selectedFile;
        preview.value = URL.createObjectURL(selectedFile);
        emit("update:modelValue", selectedFile);
    }
};

const onDrop = (event) => {
    event.preventDefault();
    const droppedFile = event.dataTransfer.files[0];
    if (droppedFile && droppedFile.type.startsWith("image/")) {
        file.value = droppedFile;
        preview.value = URL.createObjectURL(droppedFile);
        emit("update:modelValue", droppedFile);
    }
};

const onDragOver = (event) => {
    event.preventDefault();
};
</script>

<template>
    <div class="border-2 border-dashed border-gray-400 dark:border-gray-600 rounded-lg p-4 flex flex-col items-center justify-center cursor-pointer hover:border-[var(--primary-50)] transition relative min-h-[20svh]"
        @drop="onDrop" @dragover="onDragOver" @click="$refs.fileInput.click()">
        <!-- Preview -->
        <div v-if="preview" class="w-full flex justify-center mb-3">
            <img :src="preview" alt="Preview" class="max-h-48 object-contain rounded-md" />
        </div>

        <!-- Placeholder text -->
        <div v-else class="text-gray-500 dark:text-gray-400 text-sm text-center">
            Drag & drop an image here, or <span class="text-[var(--primary-50)] underline">click to select</span>
        </div>

        <!-- Hidden input -->
        <input type="file" accept="image/*" ref="fileInput" class="hidden" @change="onFileChange" />
    </div>
</template>
