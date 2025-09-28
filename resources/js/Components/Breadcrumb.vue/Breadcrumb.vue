<script setup>
import { Link } from '@inertiajs/vue3'

// Props
const props = defineProps({
    items: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <div class="flex items-center gap-1">
        <template v-for="(item, index) in items" :key="`breadcrumb-${index}`">
            <!-- Show link if URL exists and not active -->
            <Link v-if="item.url && !item.active" :href="item.url">
            {{ item.label }}
            </Link>

            <!-- Otherwise show plain text -->
            <span v-else :class="item.active ? 'text-[var(--primary-50)] font-semibold' : ''">
                {{ item.label }}
            </span>

            <!-- Separator, skip after last item -->
            <span v-if="index < items.length - 1" class="mx-1">></span>
        </template>
    </div>
</template>
