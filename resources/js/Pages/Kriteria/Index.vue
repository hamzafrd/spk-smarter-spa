<script setup>
import CrudTable from '@/Components/Crud/CrudB.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useFormStore } from '@/store';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    kriteriaList: {
        type: Array,
        default: null
    },

})
const store = useFormStore()
store.kriteriaList = props.kriteriaList

</script>

<template>

    <Head title="Kriteria" />

    <AuthenticatedLayout>
        <CrudTable />
    </AuthenticatedLayout>
</template>
resources/data/store
