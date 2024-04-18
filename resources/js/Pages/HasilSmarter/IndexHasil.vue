<script setup>
import IndexCrudTable from '@/Components/Crud/IndexCrudTable.vue';
import TableCrud from '@/Components/Crud/TableCrud.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useFormStore } from '@/store';
import { Head } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SubKriteriaModal from '@/Components/Crud/CrudModal/SubKriteriaModal.vue';
import Thead from '@/Components/Crud/Thead.vue';
import TData from '@/Components/Crud/TData.vue';

const props = defineProps({
  kriteriaList: {
    type: Array,
    default: [],
  },
});

const store = useFormStore();

const {
  setKriteria,
  setSubkriteriaList: setSubkriteria,
  toggleModal,
  moveListItem,
} = store;
const { massEdit, showBobot, kriteriaList, filteredList, searchQuery } =
  storeToRefs(store);
store.kriteriaList = props.kriteriaList;
</script>

<template>
  <Head title="Kriteria" />

  <AuthenticatedLayout>
    <SubKriteriaModal />
    <section class="h-full bg-content">
      <IndexCrudTable :list="filteredList">
        <template #header>
          <p class="text-heading1-bold">Hasil Penilaian</p>
          <!--
          <p class="text-heading2-semibold">
            Total Kriteria : {{ kriteriaList.length }}
          </p> -->
        </template>
        <template #table>
          <TableCrud
            :label="'Kriteria'"
            :list="filteredList"
            :query="searchQuery"
            :class="'lg:mx-4 lg:mb-4 lg:rounded-lg'"
          >
            <template #thead-content>
              <tr>
                <Thead v-if="!massEdit" :label="'Kriteria'" />
                <Thead :label="'Keterangan'" />
                <Thead :label="'Peringkat'" />
                <Thead v-if="!massEdit && showBobot" :label="'Bobot'" />
                <Thead v-if="!massEdit" :sort="false" :label="'Sub Kriteria'" />

                <Thead :sort="false" :label="'Aksi'" />
              </tr>
            </template>

            <template #tbody-content>
              <tr
                v-for="(item, index) in filteredList"
                class="t-row"
                :id="'kriteria' + index"
              >
                <TData v-if="!massEdit" :label="'K' + item.rank" />

                <TData :label="item.nama" />

                <td class="rankKriteria px-1 py-3">
                  {{ item.rank }}
                </td>

                <TData v-if="!massEdit && showBobot" :label="item.bobot" />
                <!-- SubKriteria -->
                <TData v-if="!massEdit">
                  <a
                    @click="
                      setSubkriteria(item.subkriteria),
                        setKriteria(item),
                        toggleModal('sub-kriteria-modal')
                    "
                    data-modal-target="sub-kriteria-modal"
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
                </TData>

                <td class="px-1 py-3 flex justify-center">
                  <div class="move-buttons" v-if="massEdit">
                    <SecondaryButton
                      @click="moveListItem(index, 'up')"
                      :disabled="index === 0"
                    >
                      <svg
                        class="w-6 h-6 text-gray-800 dark:text-white"
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
                          d="M12 6v13m0-13 4 4m-4-4-4 4"
                        />
                      </svg>
                    </SecondaryButton>
                    <SecondaryButton
                      @click="moveListItem(index, 'down')"
                      :disabled="index === kriteriaList.length - 1"
                    >
                      <svg
                        class="w-6 h-6 text-gray-800 dark:text-white"
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
                          d="M12 19V5m0 14-4-4m4 4 4-4"
                        />
                      </svg>
                    </SecondaryButton>
                  </div>

                  <!-- Aksi Dropdown -->
                  <button
                    :id="item.nama + item.id"
                    :data-dropdown-toggle="item.nama + item.id + 'dropdown'"
                    :class="massEdit ? 'hidden' : 'block'"
                    class="inline-flex items-center font-medium hover:bg-primary-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                    type="button"
                  >
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewbox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"
                      />
                    </svg>
                  </button>
                  <div
                    :id="item.nama + item.id + 'dropdown'"
                    class="hidden z-10 w-44 bg-primary-50 rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 border border-gray-200 dark:border-gray-700"
                  >
                    <ul class="py-1" :aria-labelledby="item.nama + item.id">
                      <li>
                        <button
                          type="button"
                          data-modal-target="updateProductModal"
                          data-modal-toggle="updateProductModal"
                          @click="
                            setKriteria(item), toggleModal('updateProductModal')
                          "
                          class="flex w-full items-center py-2 px-4 hover:bg-primary-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200"
                        >
                          <svg
                            class="w-6 h-6 text-gray-800 dark:text-white mr-2"
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
                              d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"
                            />
                          </svg>
                          Edit
                        </button>
                      </li>
                      <li>
                        <button
                          type="button"
                          data-modal-target="readProductModal"
                          data-modal-toggle="readProductModal"
                          @click="setKriteria(item)"
                          class="flex w-full items-center py-2 px-4 hover:bg-primary-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200"
                        >
                          <svg
                            class="w-6 h-6 text-gray-800 dark:text-white mr-2"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            fill="none"
                            viewBox="0 0 24 24"
                          >
                            <path
                              stroke="currentColor"
                              stroke-width="2"
                              d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"
                            />
                            <path
                              stroke="currentColor"
                              stroke-width="2"
                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            />
                          </svg>

                          Lihat
                        </button>
                      </li>
                      <li>
                        <button
                          type="button"
                          data-modal-target="deleteModal"
                          data-modal-toggle="deleteModal"
                          @click="setKriteria(item), toggleModal('deleteModal')"
                          class="flex w-full items-center py-2 px-4 hover:bg-primary-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400"
                        >
                          <svg
                            class="w-6 h-6 text-red-500 mr-2"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                              clip-rule="evenodd"
                            />
                          </svg>

                          Delete
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
            </template>
          </TableCrud>
        </template>
      </IndexCrudTable>
    </section>
  </AuthenticatedLayout>
</template>
s
