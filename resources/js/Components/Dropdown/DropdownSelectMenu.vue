<script setup>
// Props
const props = defineProps({
    modelValue: {
        type: [String, Number],
        required: true,
        default: ''
    },
    options: {
        type: Array,
        required: true,
        default: () => []
    },
    valueKey: {
        type: String,
        required: true,
        default: ''
    },
    labelKey: {
        type: String,
        required: true,
        default: ''
    },
    loadMore: {
        type: Boolean,
        required: false,
        default: false
    }
});

// Emits
const emit = defineEmits(['update:modelValue', 'loadMore']);

const selectOption = (option) => {
    emit('update:modelValue', option[props.valueKey]);
};

const handleLoadMore = () => {
    emit('loadMore');
};
</script>

<template>
    <div>
        <slot>
            <div v-for="option in options" :key="option[valueKey]"
                class="cursor-pointer hover:bg-gray-700 py-2 ps-2 pe-6" @click="selectOption(option)">
                {{ option[labelKey] }}
            </div>
        </slot>
    </div>

    <div data-loadmore v-if="loadMore" class="text-center py-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700"
        @click="handleLoadMore">
        Load More
    </div>
</template>
