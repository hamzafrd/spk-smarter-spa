<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useCounterStore } from '@/store';
import { Head } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';

const counterStore = useCounterStore();

// accesing action
const { increaseCount } = counterStore

// accesing state/refs and getters/computed
const { doubleCount, count } = storeToRefs(counterStore)
</script>

<template>

    <Head title="Hasil" />

    <AuthenticatedLayout>
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">Hasil</h2>
    </AuthenticatedLayout>
</template>
