<script setup>
import CreateModal from '@/Components/Crud/CrudModal/CreateModal.vue';
import SavePosisiModal from './CrudModal/SavePosisiModal.vue';
import UpdateModal from './CrudModal/UpdateModal.vue';
import ReadModal from './CrudModal/ReadModal.vue';
import DeleteModal from './CrudModal/DeleteModal.vue';
import DeleteAllModal from './CrudModal/DeleteAllModal.vue';

defineProps({
  list: {
    type: Array,
    default: [],
  },
});
</script>
<template lang="html">
  <CreateModal />
  <template v-if="list.length > 0">
    <DeleteAllModal />
    <UpdateModal />
    <ReadModal />
    <DeleteModal />
    <SavePosisiModal />
  </template>

  <div class="h-full flex flex-col antialiased relative">
    <div>
      <div
        class="flex justify-start flex-col lg:items-end md:flex-row md:justify-between dark:text-white mx-4 mt-4 lg:m-4"
      >
        <slot name="header" />
      </div>
      <div
        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
      >
        <slot name="table-header" />
        <p
          class="text-base-semibold dark:text-gray-600 text-gray-300 md:hidden"
        >
          Scroll ke kanan untuk melihat tabel >>>
        </p>
      </div>
    </div>

    <slot name="table" />
    <slot />
  </div>
</template>
