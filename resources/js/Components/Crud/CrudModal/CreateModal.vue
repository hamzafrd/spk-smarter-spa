<script setup>
import InputError from '@/Components/InputError.vue';
import { useFormStore } from '@/store';
import { storeToRefs } from 'pinia';

const storePinia = useFormStore();
const { submitForm, toggleModal } = storePinia;
const { formKriteria, dataList, category } = storeToRefs(storePinia);
</script>
<template>
  <div
    id="createProductModal"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div
        class="relative p-4 bg-gray-50 rounded-lg shadow dark:bg-gray-800 sm:p-5"
      >
        <!-- Modal header -->
        <div
          class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600"
        >
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Tambah <span class="capitalize">{{ category }}</span>
          </h3>
          <button
            type="button"
            @click="toggleModal('createProductModal')"
            data-modal-target="createProductModal"
            data-modal-toggle="createProductModal"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
          >
            <svg
              aria-hidden="true"
              class="w-5 h-5"
              fill="currentColor"
              viewbox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
              />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form
          @submit.prevent="submitForm('store', dataList.length + 1, category)"
        >
          <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
              <label
                for="name"
                class="block mb-2 font-medium text-gray-900 dark:text-white"
                >Nama Kriteria</label
              >
              <input
                type="text"
                name="name"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Masukan Nama Kriteria"
                v-model="formKriteria.nama"
              />
              <InputError class="mt-2" :message="formKriteria.errors.nama" />
            </div>
            <div>
              <label
                for="brand"
                class="block mb-2 font-medium text-gray-900 dark:text-white"
                >Peringkat</label
              >
              <input
                type="number"
                name="brand"
                id="brand"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                :placeholder="
                  'Masukan angka antara 1 s.d. ' + (dataList.length + 1)
                "
                v-model="formKriteria.rank.value"
              />

              <InputError
                class="mt-2"
                :message="formKriteria.errors['rank.value']"
              />
            </div>
          </div>
          <button
            type="submit"
            class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
          >
            <svg
              class="mr-1 -ml-1 w-6 h-6"
              fill="currentColor"
              viewbox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"
              />
            </svg>
            Tambahkan Kriteria
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
