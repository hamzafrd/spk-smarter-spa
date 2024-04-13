<script setup>
import SubKriteriaModal from '@/Components/Crud/CrudModal/SubKriteriaModal.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useFormStore } from '@/store';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  kriteriaList: {
    type: Array,
    default: null,
  },
});

useFormStore().kriteriaList = props.kriteriaList;
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <a
      data-modal-target="sub-kriteria-modal"
      data-modal-toggle="sub-kriteria-modal"
      class="flex items-center justify-center text-primary-600 dark:text-primary-500 cursor-pointer"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="w-6 h-6"
        viewBox="0 0 20 20"
        fill="currentColor"
        aria-hidden="true"
      >
        <path
          d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"
        ></path>
        <path
          d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"
        ></path>
      </svg>
      Lihat Sub Kriteria
    </a>
    <SubKriteriaModal />
  </AuthenticatedLayout>
</template>
