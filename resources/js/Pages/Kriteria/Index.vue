<script setup>
import MasterCrudTable from '@/Components/Crud/MasterCrudTable.vue';
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
        <MasterCrudTable :kriteria-list="kriteriaList" />
    </AuthenticatedLayout>
</template>
