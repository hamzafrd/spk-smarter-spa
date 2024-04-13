<script setup>
import SortArrow from '@/Components/SortArrow.vue';

import UpdateModal from '@/Components/Crud/CrudModal/UpdateModal.vue';
import ReadModal from '@/Components/Crud/CrudModal/ReadModal.vue';
import DeleteModal from '@/Components/Crud/CrudModal/DeleteModal.vue';
import SavePosisiModal from '@/Components/Crud/CrudModal/SavePosisiModal.vue';
defineProps({
  label: null,
  list: {
    type: Array,
    default: null,
  },
  query: {
    type: String,
    default: '',
  },
  class: null,
  errorMessage: null,
});
</script>
<template>
  <div
    v-if="list.length > 0"
    class="overflow-x-auto rounded-b-lg border dark:border-gray-600 border-gray-300"
    :class="class"
  >
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead
        class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400"
      >
        <slot name="thead-content" />
      </thead>
      <tbody class="child:text-center">
        <slot name="tbody-content" />
      </tbody>
    </table>
  </div>

  <div
    v-else-if="!query.trim()"
    class="dark:text-gray-500 text-heading4-medium flex-1 flex items-center justify-center"
  >
    <p class="p-12">
      {{
        errorMessage ??
        'Masukan Data Kriteria dengan cara menekan tombol + Tambah Kriteria'
      }}
    </p>
  </div>
  <div
    v-else
    class="dark:text-gray-500 text-heading4-medium flex-1 flex items-center justify-center"
  >
    <p>Data tidak Ditemukan</p>
  </div>

  <template v-if="list.length">
    <UpdateModal />
    <ReadModal />
    <DeleteModal />
    <SavePosisiModal />
  </template>
</template>
