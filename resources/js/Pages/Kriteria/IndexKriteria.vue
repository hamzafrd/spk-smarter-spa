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
import ButtonGroupTable from '@/Components/Crud/ButtonGroupTable.vue';
import DropdownDots from '@/Components/DropdownDots.vue';
import SearchInput from '@/Components/Crud/SearchInput.vue';
import { ref } from 'vue';

const props = defineProps({
  kriteriaList: {
    type: Array,
    default: null,
  },
});
const store = useFormStore();

const {
  setKriteria,
  setSubKriteriaList,
  toggleModal,
  moveListItem,
  updatePositions,
  initLib,
  submitForm,
  resetForm,
} = store;

const {
  massEdit,
  showBobot,
  filteredList,
  dataList,
  category,
  queryKriteria,
  currSort,
} = storeToRefs(store);

const child = ref(null);

dataList.value = props.kriteriaList;
category.value = 'kriteria';
queryKriteria.value = '';

const searchKriteria = (query) => {
  queryKriteria.value = query;
  initLib();
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

const handleCreate = () => {
  submitForm('store', dataList.value.length + 1, category.value, 'main');
};
const handleShowCreate = () => {
  toggleModal(`createProductModalmain`);
  resetForm();
};

const handleUpdate = () => {
  submitForm('update', dataList.value.length + 1, category.value, 'main');
};
const handleShowUpdate = (item) => {
  setKriteria(item), toggleModal('updateProductModalmain');
};

const handleShowDelete = (item) => {
  setKriteria(item), toggleModal('deleteModal');
};
const handleDelete = () => {
  submitForm('delete', null, store.category);
};
</script>

<template>
  <Head title="Kriteria" />

  <AuthenticatedLayout>
    <section class="h-full bg-content">
      <IndexCrudTable>
        <template #header>
          <p class="text-heading1-bold">Kriteria</p>

          <p class="text-heading2-semibold">
            Total Kriteria : {{ dataList.length }}
          </p>
        </template>
        <template #table-header>
          <SearchInput
            ref="child"
            label="Kriteria"
            :is-edit="massEdit"
            @search="searchKriteria"
          />
          <ButtonGroupTable
            id="main"
            @on-click-atur-posisi="handleAturPosisi"
            @on-show-create="handleShowCreate"
            @on-mass-edit="handleMassEdit"
          />
        </template>
        <template #table>
          <TableCrud
            id="main"
            :max-rank="dataList.length + 1"
            :list="filteredList"
            :search-query="queryKriteria"
            :class="'lg:mx-4 lg:mb-4 lg:rounded-lg'"
            @create="handleCreate"
            @update="handleUpdate"
            @delete="handleDelete"
          >
            <SubKriteriaModal />

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
                      setSubKriteriaList(item.subkriteria),
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
                  <!-- Arrow Button -->
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

                  <DropdownDots v-if="!massEdit" :id="`Kriteria${item.id}`">
                    <li>
                      <button
                        id="editKriteria"
                        class="dropdownDotItem"
                        @click="handleShowUpdate(item)"
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
                        class="dropdownDotItem"
                        @click="setKriteria(item)"
                        data-modal-target="readProductModal"
                        data-modal-toggle="readProductModal"
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
                        class="dropdownDotItem"
                        @click="handleShowDelete(item)"
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
                  </DropdownDots>
                </td>
              </tr>
            </template>
          </TableCrud>
        </template>
      </IndexCrudTable>
    </section>
  </AuthenticatedLayout>
</template>
