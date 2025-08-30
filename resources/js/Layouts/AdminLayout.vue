<template>
    <div class="flex gap-8 min-h-screen bg-[#f9f8fb] dark:bg-[#18122b] text-gray-900 dark:text-gray-100 p-6">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="bg-white dark:bg-[#1f1b2e] p-4 shadow-sm rounded-xl">
                <h1 class="text-xl font-semibold">Welcome, Admin</h1>
                <FontAwesomeIcon :icon="['fas', 'sun']" class="text-yellow-500" />
                <FontAwesomeIcon :icon="['fas', 'moon']" class="text-yellow-500" />
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import Sidebar from '@/Components/Sidebar/Sidebar.vue';
</script>
