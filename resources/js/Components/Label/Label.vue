<script setup>
// Props
const props = defineProps({
    for: {
        type: String,
        required: false,
        default: ''
    },
    mandatory: {
        type: Boolean,
        required: false,
        default: false
    },
    extraClass: {
        type: [String, Array],
        required: false,
        default: []
    }
});
</script>

<template>
    <label :for="for" :class="extraClass">
        <slot />
        <span v-if="mandatory" class="text-red-400 ms-2">*</span>
    </label>
</template>
