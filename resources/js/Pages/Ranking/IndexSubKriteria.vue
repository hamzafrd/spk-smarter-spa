<script setup>
import IndexCrudTable from '@/Components/Crud/IndexCrudTable.vue';
import TableCrud from '@/Components/Crud/TableCrud.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useFormStore } from '@/store';
import { Head, useForm } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Thead from '@/Components/Crud/Thead.vue';
import TData from '@/Components/Crud/TData.vue';
import SearchInput from '@/Components/Crud/SearchInput.vue';
import ButtonGroupTable from '@/Components/Crud/ButtonGroupTable.vue';
import { computed, ref } from 'vue';
const store = useFormStore();

const { setKriteria, toggleModal, moveListItem, submitForm, resetForm } = store;
const { massEdit, dataList, filteredList, category, queryKriteria, form } =
  storeToRefs(store);

category.value = 'subkriteria';

const props = defineProps({
  listAlternatif: {
    type: Array,
    default: [],
  },
  listKriteria: {
    type: Array,
    default: [],
  },
});
const currentSubLen = props.listAlternatif.length;

const formattedList = computed(() => {
  return props.listAlternatif.map((kriteria) => {
    // Sort the subkriteria array by rank
    const sortedSubkriteria = kriteria.subkriteria.sort(
      (a, b) => a.rank - b.rank
    );

    // Return the kriteria object with sorted subkriteria
    return {
      ...kriteria,
      nama: `${kriteria.nama} (K${kriteria.rank})`,
      subkriteria: sortedSubkriteria,
    };
  });
});

dataList.value = formattedList.value;

const searchKriteria = (query) => {
  queryKriteria.value = query;
};
const searchSubKriteria = (query, id) => {
  if (!query.trim()) {
    dataList.value = formattedList.value;
    return;
  }

  const filteredList = formattedList.value.map((kriteria) => {
    if (kriteria.id === id) {
      return {
        ...kriteria,
        subkriteria: kriteria.subkriteria.filter((subkriteria) => {
          const filteredQuery = query.toLowerCase();
          return subkriteria.nama.toLowerCase().includes(filteredQuery);
        }),
      };
    } else {
      return kriteria;
    }
  });
  dataList.value = filteredList;
};

const handleAturPosisi = () => {
  massEdit.value = !massEdit.value;
  currSort.value = 0;

  // Clear Search
  child.value.clearQuery();
  queryKriteria.value = '';
};

const handleMassEdit = () => {
  massEdit.value = !massEdit.value;
  updatePositions();
  initLib();
};

const handleCreate = (max, id) => {
  form.value.id = id;
  submitForm('store', max, category.value, `sk${id}`);
};
const handleShowCreate = (id) => {
  toggleModal(`createProductModal${id}`);
  resetForm();
};

const handleUpdate = () => {
  submitForm('update', dataList.value.length + 1, category.value, id);
};
const handleShowUpdate = (item, id) => {
  setKriteria(item), toggleModal(`updateProductModal${id}`);
};
</script>

<template>
  <Head title="Sub Kriteria" />

  <AuthenticatedLayout>
    <section class="h-full">
      <IndexCrudTable :list="formattedList" id="main">
        <template #header>
          <h1 class="lg:text-heading1-bold text-heading2-bold">Sub Kriteria</h1>

          <p class="lg:text-heading2-semibold text-heading4-medium">
            Total Sub Kriteria : {{ currentSubLen }}
          </p>
        </template>
        <template #table-header>
          <div class="w-6/12 max-md:w-full bg-content p-4 rounded-lg">
            <p
              class="text-start max-md:text-center lg:text-heading4-medium text-body-semibold dark:text-gray-300 text-gray-800 pb-2"
            >
              Cari Kriteria :
            </p>
            <SearchInput
              label="Kriteria"
              :is-edit="massEdit"
              @search="searchKriteria"
            />
          </div>
        </template>
        <template #table>
          <template v-for="kriteria in filteredList">
            <TableCrud
              :list="kriteria.subkriteria"
              :id="`sk${kriteria.id}`"
              :max-rank="kriteria.subkriteria.length + 1"
              errorMessage="Belum memiliki sub kriteria"
              class="lg:mx-4 lg:mb-4 lg:rounded-lg"
              wrapper="bg-content lg:m-2 my-2"
              @create="
                handleCreate(kriteria.subkriteria.length + 1, kriteria.id)
              "
              @update="handleUpdate"
            >
              <template #sub-table-header>
                <div
                  class="flex flex-col md:flex-row justify-between p-4 text-center"
                >
                  <p
                    class="lg:text-heading3-bold text-heading3-bold my-3 text-gray-800 dark:text-gray-100"
                  >
                    {{ kriteria.nama }}
                  </p>
                  <div
                    class="flex flex-col space-y-3 md:flex-row md:space-x-4 md:space-y-0 items-center"
                  >
                    <SearchInput
                      label="Sub Kriteria"
                      :is-edit="false"
                      @search="(e) => searchSubKriteria(e, kriteria.id)"
                    />
                    <ButtonGroupTable
                      :id="`sk${kriteria.id}`"
                      @on-click-atur-posisi="handleAturPosisi"
                      @on-show-create="handleShowCreate(`sk${kriteria.id}`)"
                      @on-mass-edit="handleMassEdit"
                    />
                  </div>
                </div>
              </template>
              <template #thead-content>
                <tr>
                  <Thead v-if="!massEdit" :label="'Sub kriteria'" />
                  <Thead :label="'Keterangan'" />
                  <Thead :label="'Peringkat'" />
                  <Thead v-if="!massEdit" :label="'Bobot'" />

                  <Thead :sort="false" :label="'Aksi'" />
                </tr>
              </template>

              <template #tbody-content>
                <tr
                  v-for="(item, index) in kriteria.subkriteria"
                  class="t-row"
                  :id="'kriteria' + index"
                >
                  <TData v-if="!massEdit" :label="'SK' + item.rank" />

                  <TData :label="item.nama" />

                  <td class="rankKriteria px-1 py-3">
                    {{ item.rank }}
                  </td>

                  <TData v-if="!massEdit" :label="item.bobot" />

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
                        :disabled="index === listKriteria.length - 1"
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
                            @click="handleShowUpdate(`sk${item.id}`)"
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
                            @click="
                              setKriteria(item), toggleModal('deleteModal')
                            "
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
        </template>
      </IndexCrudTable>
    </section>
  </AuthenticatedLayout>
</template>
