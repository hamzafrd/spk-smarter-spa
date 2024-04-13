<script setup>
import { useFormStore } from '@/store';
import TableCrud from '../TableCrud.vue';
import Thead from '../Thead.vue';
import TData from '../TData.vue';
import { storeToRefs } from 'pinia';
const store = useFormStore();

const { subKriteriaList, kriteria } = storeToRefs(store);
</script>
<template>
  <!-- Main modal -->
  <div
    id="sub-kriteria-modal"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-gray-300 rounded-lg shadow dark:bg-gray-800">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between border-b rounded-t dark:border-gray-600 py-2 px-4"
        >
          <h3
            class="text-body-normal font-semibold text-gray-900 dark:text-white"
          >
            Daftar sub kriteria pada K{{ kriteria.rank }} ({{ kriteria.nama }})
          </h3>
          <button
            type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="sub-kriteria-modal"
          >
            <svg
              class="w-3 h-3"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 14"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
              />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <TableCrud
          :list="subKriteriaList"
          :label="'Sub Kriteria'"
          :error-message="'Tidak Memiliki Sub Kriteria'"
        >
          <template #thead-content>
            <Thead :label="'Sub Kriteria'" :sort="false" />
            <Thead :label="'Keterangan'" :sort="false" />
            <Thead :label="'Peringkat'" :sort="false" />
            <Thead :label="'Bobot'" :sort="false" />
          </template>
          <template #tbody-content>
            <tr
              v-if="subKriteriaList.length > 0"
              v-for="(item, index) in store.subKriteriaList"
              class="t-row"
              :id="'kriteria' + index"
            >
              <TData :label="'SK' + (index + 1)" />
              <TData :label="item.nama" />
              <TData :label="item.rank" />
              <TData :label="item.bobot" />
            </tr>
          </template>
        </TableCrud>
      </div>
    </div>
  </div>
</template>
