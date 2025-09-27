<script setup>
// Props
const props = defineProps({
    modelValue: {
        type: String,
        required: true,
        default: ''
    },
    id: {
        type: String,
        required: false,
        default: ''
    },
    placeholder: {
        type: String,
        required: false,
        default: ''
    },
    background: {
        type: [String, Array],
        required: false,
        default: () => ['bg-gray-50', 'dark:bg-[var(--dark-bg-150)]']
    },
    border: {
        type: [String, Array],
        required: false,
        default: () => ['border', 'border-gray-300', 'dark:border-[var(--dark-bg-50)]', 'focus:border-[var(--primary-50)]', 'rounded-md']
    },
    padding: {
        type: [String, Array],
        required: false,
        default: () => ['p-2']
    },
    position: {
        type: [String, Array],
        required: false,
        default: () => ['relative']
    },
    transition: {
        type: [String, Array],
        required: false,
        default: () => ['transition']
    },
    focus: {
        type: [String, Array],
        required: false,
        default: () => ['focus:outline-none']
    },
    extraClass: {
        type: [String, Array],
        required: false,
        default: () => []
    }
});

// Emits
const emit = defineEmits(['update:modelValue']);

</script>

<template>
    <input :id="id" type="text" :placeholder="placeholder" :value="modelValue" :class="[
        ...background,
        ...border,
        ...padding,
        ...position,
        ...transition,
        ...focus,
        ...extraClass
    ]" @input="emit('update:modelValue', $event.target.value)" />
</template>
