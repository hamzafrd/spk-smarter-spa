<script setup>
import CrudTable from '@/Components/Crud/CrudTable.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    kriteriaList: {
        type: Array,
        default: null
    },

})
</script>

<template>

    <Head title="Kriteria" />

    <AuthenticatedLayout>
        <CrudTable :kriteria-list="kriteriaList" />
    </AuthenticatedLayout>
</template>
resources/data/store
