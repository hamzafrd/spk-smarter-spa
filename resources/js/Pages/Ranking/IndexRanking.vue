<script setup>
import IndexCrudTable from '@/Components/Crud/IndexCrudTable.vue';
import TableCrud from '@/Components/Crud/TableCrud.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useFormStore } from '@/store';
import { Head, useForm } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DropdownDots from '@/Components/DropdownDots.vue';
import Thead from '@/Components/Crud/Thead.vue';
import TData from '@/Components/Crud/TData.vue';
import { computed, ref } from 'vue';
import SearchInput from '@/Components/Crud/SearchInput.vue';

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

const formattedKriteriaList = computed(() => {
  return props.listKriteria.map((kriteria) => {
    return {
      ...kriteria,
      subkriteria: kriteria.subkriteria.sort((a, b) => a.rank - b.rank),
    };
  });
});

const rankingList = computed(() => {
  return props.listAlternatif.map((alternatif) => {
    return {
      ...alternatif,
      kriteria: formattedKriteriaList.value,
    };
  });
});

const store = useFormStore();

const { setKriteria, toggleModal, submitForm, resetForm } = store;
const { massEdit, dataList, category, queryKriteria, currSort } =
  storeToRefs(store);

category.value = 'Perankingan';

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
  submitForm('store', category.value, 'main');
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

const selectedOptions = ref({});

const handleSaveRanking = () => {
  const groupedValues = {};

  for (const key in selectedOptions.value) {
    const id = parseInt(key.slice(-1));
    if (!groupedValues[id]) {
      groupedValues[id] = { id, value: [] };
    }
    groupedValues[id].value.push(selectedOptions.value[key]);
  }

  // Convert object to array
  const mergedArray = Object.values(groupedValues);
  if (mergedArray.length) {
    const subkriteriaLen = rankingList.value[0].kriteria[0].subkriteria.length;
    mergedArray.forEach((e) => {
      if (e.value.length !== subkriteriaLen) {
        console.log('lengkapi data, id : ' + e.id);
      } else {
        const form = useForm({});
        console.log('sudah lengkap');
      }
    });
  }
};
const handleSelectOption = (event, id) => {
  selectedOptions.value[id] = event.target.value;
};
</script>

<template>
  <Head title="Kriteria" />

  <AuthenticatedLayout>
    <section class="h-full bg-content">
      <IndexCrudTable>
        <template #header>
          <p class="text-heading1-bold">Pemilihan Kriteria Alternatif</p>

          <p class="text-heading2-semibold">
            Jumlah : {{ rankingList.length }}
          </p>
        </template>
        <template #table-header>
          <div class="w-6/12 max-md:w-full bg-content p-4 rounded-lg">
            <p
              class="text-start max-md:text-center lg:text-heading4-medium text-body-semibold dark:text-gray-300 text-gray-800 pb-2"
            >
              Cari Alternatif :
            </p>
            <SearchInput label="Alternatif" :is-edit="massEdit" @search="" />
          </div>
        </template>
        <template #table>
          <template v-for="alternatif in rankingList">
            <TableCrud
              :list="alternatif.kriteria"
              :id="`alr${alternatif.id}`"
              :max-rank="1"
              errorMessage="Masukan Kriteria Terlebih Dahulu"
              class="lg:mx-4 lg:mb-4 lg:rounded-lg"
              wrapper="bg-content lg:m-2 my-2"
            >
              <template #sub-table-header>
                <div
                  class="flex flex-col md:flex-row justify-between p-4 text-center"
                >
                  <p
                    class="lg:text-heading3-bold text-heading3-bold my-3 text-gray-800 dark:text-gray-100"
                  >
                    {{ alternatif.nama }}
                  </p>
                  <button
                    @click="handleSaveRanking(alternatif.id)"
                    class="px-3 max-h-12 capitalize flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                  >
                    Save
                  </button>
                </div>
              </template>
              <template #thead-content>
                <tr>
                  <Thead class="px-3" :label="'Kriteria'" :sort="false" />
                  <Thead
                    :label="'Pilih Sub Kriteria yang Sesuai'"
                    :sort="false"
                  />
                </tr>
              </template>

              <template #tbody-content>
                <tr
                  v-for="(item, index) in alternatif.kriteria"
                  class="t-row"
                  :id="'kriteriaAlr' + alternatif.id"
                >
                  <TData :label="item.nama" class="px-3" />

                  <TData class="px-3">
                    <select
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      @change="
                        handleSelectOption(
                          $event,
                          'select' + index + alternatif.id
                        )
                      "
                    >
                      <option value="">Choose a Sub Kriteria</option>
                      <template v-for="subkriteria in item.subkriteria">
                        <option :value="subkriteria.id">
                          {{ subkriteria.nama }}
                        </option>
                      </template>
                    </select>
                  </TData>
                </tr>
              </template>
            </TableCrud>
          </template>
        </template>
      </IndexCrudTable>
    </section>
  </AuthenticatedLayout>
</template>
