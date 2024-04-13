<script setup>
import { useFormStore } from '@/store';
import { storeToRefs } from 'pinia';
import CreateModal from '@/Components/Crud/CrudModal/CreateModal.vue';
import DeleteAllModal from './CrudModal/DeleteAllModal.vue';

const props = defineProps({
  list: {
    type: Array,
    default: null,
  },
  label: {
    type: String,
    default: null,
  },
});

const store = useFormStore();
const { updatePositions, toggleModal, loadListSpa, resetForm, handleSearch } =
  store;
const { massEdit, showBobot, searchQuery, sorted } = storeToRefs(store);
</script>
<template lang="html">
  <CreateModal :list="list" />
  <DeleteAllModal />

  <div
    class="h-full flex flex-col bg-white dark:bg-gray-800 lg:border border-gray-300 dark:border-gray-700 lg:rounded-lg shadow-sm antialiased relative"
  >
    <!-- Header -->
    <div
      class="flex justify-start flex-col lg:items-end md:flex-row md:justify-between dark:text-white mx-4 mt-4 lg:m-4"
    >
      <p class="text-heading1-bold">{{ props.label }}</p>

      <p class="text-heading2-semibold">
        <slot name="header" />
      </p>
    </div>

    <!-- Table Header -->
    <div
      class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
    >
      <!-- Left (Search Bar) -->
      <div class="w-full md:w-1/2">
        <form class="flex items-center">
          <label for="simple-search" class="sr-only">Search</label>
          <div class="relative w-full">
            <div
              class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
            >
              <svg
                aria-hidden="true"
                class="w-5 h-5 text-gray-500 dark:text-gray-400"
                fill="currentColor"
                viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"
                />
              </svg>
            </div>
            <input
              type="text"
              id="simple-search"
              v-model="searchQuery"
              @input="handleSearch()"
              :disabled="massEdit"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              :placeholder="
                massEdit
                  ? 'Kembali ke awal untuk melakukan pencarian'
                  : 'search'
              "
              required="true"
            />
          </div>
        </form>
      </div>

      <!-- Right -->
      <div
        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
      >
        <button
          type="button"
          id="createProductModalButton"
          @click="toggleModal('createProductModal'), resetForm()"
          data-modal-target="createProductModal"
          data-modal-toggle="createProductModal"
          class="px-3 py-2 flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
        >
          <svg
            class="w-6 h-6 text-white mr-1"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            fill="none"
            viewBox="0 0 24 24"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
            />
          </svg>

          Tambah Kriteria
        </button>
        <button
          v-if="massEdit"
          @click="updatePositions(), (massEdit = !massEdit)"
          type="button"
          class="p-2 flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
        >
          Save Posisi Kriteria
        </button>

        <!-- Dropdown -->
        <div
          v-if="list.length"
          class="flex items-center space-x-3 w-full md:w-auto"
        >
          <button
            id="actionsDropdownButton"
            data-dropdown-toggle="actionsDropdown"
            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
            type="button"
          >
            <svg
              class="-ml-1 mr-1.5 w-5 h-5"
              fill="currentColor"
              viewbox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              />
            </svg>
            Pengaturan Tabel
          </button>
          <div
            id="actionsDropdown"
            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
          >
            <ul
              class="py-1 text-sm text-gray-700 dark:text-gray-200"
              aria-labelledby="actionsDropdownButton"
            >
              <li>
                <a
                  href="#"
                  v-if="!massEdit"
                  @click="
                    (massEdit = !massEdit),
                      sorted ? (sorted = !sorted) : null,
                      (searchQuery = ''),
                      loadListSpa()
                  "
                  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                >
                  Atur Posisi
                </a>
                <a
                  href="#"
                  :class="massEdit ? 'block' : 'hidden'"
                  type="button"
                  @click="toggleModal('simpanPosisiModal')"
                  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                >
                  Kembali ke awal
                </a>
              </li>
              <li>
                <a
                  href="#"
                  v-if="!massEdit"
                  @click="showBobot = !showBobot"
                  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                >
                  <template v-if="!showBobot"> Tampilkan Bobot </template>
                  <template v-else> Sembunyikan Bobot </template>
                </a>
              </li>
            </ul>
            <div class="py-1">
              <a
                href="#"
                data-modal-target="deleteAllModal"
                @click="toggleModal('deleteAllModal')"
                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                >Delete all</a
              >
            </div>
          </div>
        </div>
      </div>
      <p class="text-base-semibold dark:text-gray-600 text-gray-300 md:hidden">
        Scroll ke kanan untuk melihat tabel >>>
      </p>
    </div>

    <slot name="table" />
    <slot />
  </div>
</template>
