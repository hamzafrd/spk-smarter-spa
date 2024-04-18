<script setup>
defineProps({
  class: null,
  errorMessage: null,
  list: {
    type: Array,
    default: [],
  },
  searchQuery: {
    type: String,
    default: '',
  },
  wrapper: null,
});
</script>
<template>
  <div :class="wrapper">
    <slot name="sub-table-header" />

    <div v-if="list.length > 0" class="table-container" :class="class">
      <table class="table">
        <thead class="t-head">
          <slot name="thead-content" />
        </thead>
        <tbody>
          <slot name="tbody-content" />
        </tbody>
      </table>
    </div>

    <div
      v-else-if="!searchQuery.trim()"
      class="dark:text-gray-500 text-heading4-medium flex-1 flex items-center justify-center"
    >
      <p class="pb-12 pt-10">
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
  </div>
</template>
