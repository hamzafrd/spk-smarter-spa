<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
    </AuthenticatedLayout>
</template>
