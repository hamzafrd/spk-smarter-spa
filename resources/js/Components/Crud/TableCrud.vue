<script setup>
import CreateModal from '@/Components/Crud/CrudModal/CreateModal.vue';
import SavePosisiModal from './CrudModal/SavePosisiModal.vue';
import UpdateModal from './CrudModal/UpdateModal.vue';
import ReadModal from './CrudModal/ReadModal.vue';
import DeleteModal from './CrudModal/DeleteModal.vue';
import DeleteAllModal from './CrudModal/DeleteAllModal.vue';

const props = defineProps({
  id: {
    type: String,
    default: 'main',
  },
  maxRank: {
    type: Number,
    default: null,
  },
  list: {
    type: Array,
    default: [],
  },
  searchQuery: {
    type: String,
    default: '',
  },

  class: null,
  wrapper: null,
  errorMessage: null,

  isSmarter: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits([
  'create',
  'update',
  'delete',
]);

</script>
<template>
  <template v-if="!isSmarter">
    <CreateModal @submit-form="emit('create')" :max-rank="props.maxRank" :id="props.id" />
    <template v-if="list.length > 0">
      <DeleteAllModal />
      <UpdateModal @submit-form="emit('update')" :max-rank="props.maxRank" :id="props.id" />
      <ReadModal />
      <DeleteModal @submit-form="emit('delete')" />
      <SavePosisiModal />
    </template>
  </template>

  <slot />
  <div :class="wrapper" :id="id">
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

    <div v-else-if="!searchQuery.trim()"
      class="dark:text-gray-500 text-heading4-medium flex-1 flex items-center justify-center">
      <p class="pb-12 pt-10">
        {{
          errorMessage ??
          'Masukan Data Kriteria dengan cara menekan tombol + Tambah Kriteria'
        }}
      </p>
    </div>
    <div v-else class="dark:text-gray-500 text-heading4-medium flex-1 flex items-center justify-center">
      <p>Data tidak Ditemukan</p>
    </div>
  </div>
</template>
