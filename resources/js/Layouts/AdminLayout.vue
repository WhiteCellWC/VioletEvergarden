<script setup>
import Sidebar from '@/Components/Sidebar/Sidebar.vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage()
</script>


<template>
    <div
        class="min-xl:grid min-xl:grid-cols-5 gap-8 min-h-screen bg-[var(--light-bg-50)] dark:bg-[var(--dark-bg-200)] text-gray-900 dark:text-gray-100 p-6">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Main Content -->
        <div class="col-span-4 flex flex-col gap-4">
            <!-- Topbar -->
            <header
                class="bg-white dark:bg-[var(--dark-bg-100)] p-4 shadow-sm rounded-xl flex items-center justify-between">
                <h1 class="text-xl font-semibold">Welcome, Admin</h1>
                <div>
                    <FontAwesomeIcon :icon="['fas', 'sun']" class="text-yellow-500" />
                    <FontAwesomeIcon :icon="['fas', 'moon']" class="text-yellow-500" />
                </div>
            </header>

            <!-- Page Content -->
            <slot name="breadcrumb" />

            <div v-if="page.props.flash?.status" class="mb-4 px-4 py-2 rounded-md bg-green-500 text-white">
                {{ page.props.flash.status.msg }}
            </div>

            <div class="bg-white dark:bg-[var(--dark-bg-100)] rounded-2xl min-h-[81svh] overflow-auto shadow-sm">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
