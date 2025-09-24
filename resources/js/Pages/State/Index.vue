<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js';

//Props
const props = defineProps({
    states: {
        type: Object,
        required: false,
        default: () => ({
            data: [],
            links: {},
            meta: {},
        })
    }
})

</script>

<template>
    <AdminLayout>
        <template #breadcrumb>
            <div>
                Dashboard > <span class="text-[var(--primary-50)]">State</span>
            </div>
        </template>
        <template #content>
            <div class="px-4 py-2 bg-gray-600">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold">States</h2>
                    <Link :href="route('states.create')"
                        class="bg-[var(--primary-50)] text-black hover:bg-[var(--primary-100)] px-2 py-1 rounded font-bold">
                    <FontAwesomeIcon :icon="['fas', 'plus']" class="text-black me-1" />
                    <span>Create State</span>
                    </Link>
                </div>
            </div>

            <div class="p-4">
                <div class="flex">
                    <div>
                        <label>Show:</label>
                    </div>
                </div>
                <div class="overflow-auto rounded-lg border border-gray-300 dark:border-gray-700">
                    <table class="w-full">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-start">ID</th>
                                <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-start">Name</th>
                                <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-start">Country
                                </th>
                                <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-start">Created
                                    At
                                </th>
                                <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-start">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(state, i) in states.data" :key="state.id"
                                class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ i +
                                    states.meta?.from
                                }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ state.name }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{
                                    state.country.name }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ state.created_at
                                }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </template>
    </AdminLayout>
</template>
