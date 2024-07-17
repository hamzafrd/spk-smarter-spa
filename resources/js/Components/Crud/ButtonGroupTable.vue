<script setup>
import { useFormStore } from '@/store';
import { storeToRefs } from 'pinia';
import DropdownHover from '../DropdownHover.vue';

const props = defineProps({
  id: {
    type: String,
    default: 'main',
  },
  showSetting: {
    type: Boolean,
    default: false,
  }
});
const store = useFormStore();
const { massEdit, showBobot, filteredList, category } = storeToRefs(store);

const emit = defineEmits(['onClickAturPosisi', 'onShowCreate', 'onMassEdit']);
const handlePosisi = () => {
  emit('onClickAturPosisi');
};

const handleShowCreate = () => {
  emit('onShowCreate');
};

const handleMassEdit = () => {
  emit('onMassEdit');
};

</script>
<template>
  <div
    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
    <button type="button" @click="handleShowCreate()" :data-modal-target="`createProductModal${id}`"
      :data-modal-toggle="`createProductModal${id}`"
      class="px-3 py-2 capitalize flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
      <svg class="w-6 h-6 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
        fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>

      Tambah {{ category }}
    </button>
    <button v-if="massEdit" data-modal-hide="default-modal" @click="handleMassEdit()" type="button"
      class="p-2 flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
      Save Posisi Kriteria
    </button>

    <!-- Dropdown -->
    <div :class="filteredList.length > 0 && props.showSetting ? 'flex' : 'hidden'"
      class="items-center space-x-3 w-full md:w-auto">
      <DropdownHover :id="id">
        <template #contentTop>
          <li>
            <button :class="!massEdit ? 'block' : 'hidden'" @click="handlePosisi()" class="dropdownHoverItem">
              Atur Posisi
            </button>
            <button :class="massEdit ? 'block' : 'hidden'" :data-modal-target="massEdit ? 'simpanPosisiModal' : null"
              :data-modal-toggle="massEdit ? 'simpanPosisiModal' : null" class="dropdownHoverItem">
              Kembali Ke Awal
            </button>
          </li>
          <li>
            <button :class="!massEdit ? 'block' : 'hidden'" @click="showBobot = !showBobot" class="dropdownHoverItem">
              <template v-if="!showBobot"> Tampilkan Bobot </template>
              <template v-else> Sembunyikan Bobot </template>
            </button>
          </li>
        </template>

        <button :data-modal-target="filteredList.length > 0 && props.showSetting ? 'deleteAllModal' : null"
          :data-modal-toggle="filteredList.length > 0 && props.showSetting ? 'deleteAllModal' : null"
          class="dropdownHoverItem bg-red-500 hover:bg-red-800">
          Delete All Data
        </button>
      </DropdownHover>
    </div>
  </div>
</template>
