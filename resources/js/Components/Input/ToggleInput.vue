<script setup>
import Label from '@/Components/Label/Label.vue';
import { computed } from "vue";

// Props
const props = defineProps({
    modelValue: {
        type: [Boolean, Number],
        default: false,
    },
    disabled: {
        type: [Boolean, Number],
        default: false,
    },
    label: {
        type: String,
        default: "",
    },
    mandatory: {
        type: [Boolean, Number],
        default: false
    }
});

// Emits
const emit = defineEmits(["update:modelValue"]);

// Computed
const checked = computed({
    get: () => props.modelValue,
    set: (val) => emit("update:modelValue", val),
});

// Toggle handler
const toggle = () => {
    if (!props.disabled) {
        checked.value = !checked.value;
    }
};
</script>

<template>
    <div class="flex flex-col gap-2 cursor-pointer select-none" @click="toggle" role="switch" :aria-checked="checked"
        :aria-disabled="disabled">
        <!-- Optional label -->
        <Label :mandatory="mandatory" :class="{ 'opacity-50': disabled }">{{ label }}</Label>

        <!-- Toggle button -->
        <div class="w-12 h-6 flex items-center rounded-full transition-colors"
            :class="checked ? 'bg-[var(--primary-50)]' : 'bg-gray-300 dark:bg-gray-600'">
            <div class="w-5 h-5 bg-white rounded-full shadow-md transform transition-transform"
                :class="checked ? 'translate-x-6' : 'translate-x-1'" />
        </div>
    </div>
</template>
