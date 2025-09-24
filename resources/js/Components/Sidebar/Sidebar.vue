<script setup>
import { onMounted, ref } from 'vue'
import logo from '@/assets/logo/violet-evergarden-admin-dashboard.png'
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const locationOpen = ref(false)

onMounted(() => {
    if (route().current('states.*') || route().current('countries.*')) {
        locationOpen.value = true;
    }
})


</script>

<template>
    <div
        class="col-span-1 bg-white dark:bg-[var(--dark-bg-100)] max-xl:hidden rounded-2xl shadow-sm p-4 max-h-[93svh] sticky top-6 overflow-y-auto">
        <!-- Logo -->
        <div class="flex items-center gap-4">
            <img :src="logo" alt="Logo" class="rounded-full w-16" />
            <div class="flex flex-col items-center font-bold text-[var(--primary-50)]">
                <span>Violet</span>
                <span>Evergarden</span>
            </div>
        </div>

        <!-- Nav -->
        <nav class="space-y-2 mt-4">
            <Link :href="route('dashboard')" class="block p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-200 dark:bg-gray-600 font-semibold': route().current('dashboard') }">
            Dashboard</Link>
            <a href="#" class="block p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Users</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Letters</a>
            <a href="#" class="block p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Packages</a>

            <!-- Dropdown -->
            <div>
                <button @click="locationOpen = !locationOpen"
                    class="w-full flex items-center justify-between p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span>Location</span>
                    <svg :class="{ 'rotate-90': locationOpen }" class="w-4 h-4 transition-transform" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div v-show="locationOpen" class="ml-4 mt-2 space-y-1 transition-all duration-200">
                    <Link :href="route('countries.index')"
                        class="block p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
                        :class="{ 'bg-gray-200 dark:bg-gray-600 font-semibold': route().current('countries.*') }">Country
                    </Link>
                    <Link :href="route('states.index')"
                        class="block p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
                        :class="{ 'bg-gray-200 dark:bg-gray-600 font-semibold': route().current('states.*') }">State
                    </Link>
                </div>
            </div>
        </nav>
    </div>
</template>
