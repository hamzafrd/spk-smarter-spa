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
import { computed, nextTick, ref } from 'vue';
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
  listSmarter: {
    type: Array,
    default: [],
  },
});

// let groupedAlternatif = [];
$(document).ready(function () {
  props.listSmarter.forEach((e) => {
    // groupedAlternatif.push({
    //   id: e.alternatif_id,
    //   value: []
    // });

    $(`#alr${e.alternatif_id} #kriteria${e.kriteria_id} select`).val(`${e.kriteria_id},${e.sub_kriteria_id}`);
  });

  // const uniqueData = Object.values(
  //   groupedAlternatif.reduce((acc, item) => {
  //     if (!acc[item.id]) {
  //       acc[item.id] = item;
  //     }
  //     return acc;
  //   }, {})
  // );

  // uniqueData.forEach(e => {
  //   props.listSmarter.forEach(item => {
  //     if (e.id === item.alternatif_id) {
  //       e.value.push(`${item.kriteria_id},${item.sub_kriteria_id}`);
  //     }
  //   });
  // });

  // groupedAlternatif = uniqueData;
})

const formattedKriteriaList = computed(() => {
  return props.listKriteria.map((kriteria) => {
    return {
      ...kriteria,
      subkriteria: kriteria.subkriteria.sort((a, b) => a.rank - b.rank),
    };
  });
});

const listAlternatifs = ref([...props.listAlternatif])
const rankingList = computed(() => {
  return listAlternatifs.value.map((alternatif) => {
    return {
      ...alternatif,
      kriteria: formattedKriteriaList.value,
    };
  });
});

const handleSaveRanking = (id) => {
  let testValue = []
  const alternatifId = id;
  $(`.kriteriaAlr${id} select`).each(function (index) {
    testValue.push($(this).val())
  });

  const filteredData = testValue.filter(item => item !== "");
  const mergedArray = {
    id: alternatifId,
    value: filteredData
  }

  if (mergedArray) {
    const kriteriaLen = rankingList.value[0].kriteria.length;
    if (mergedArray.value.length !== kriteriaLen || mergedArray.value == '') {
      rankingList.value.forEach((ranking) => {
        if (mergedArray.id === ranking.id) {
          Swal.fire(
            'Lengkapi Data Alternatif',
            'Alternatif ' + ranking.nama + ' belum lengkap',
            'error'
          )
        }
      })

      $('#alr' + mergedArray.id).addClass('border border-red-500');
    } else {
      rankingList.value.forEach((ranking) => {
        if (mergedArray.id === ranking.id) {
          $('#alr' + mergedArray.id).removeClass('border border-red-500');



          const form = useForm({
            alternatif_id: mergedArray.id,
            kriteria_subKriteria: mergedArray.value,
          });

          form.post(route('ranking.store'), {
            preserveScroll: true,
            onSuccess: () => {
              Swal.fire(
                'Berhasil',
                'Penilaian ' + ranking.nama + ' berhasil disimpan',
                'success'
              )
            },
            onFailure: () => {
              Swal.fire(
                'Gagal Post Database',
                'Penilaian ' + ranking.nama + ' gagal disimpan',
                'success'
              )
            }
          });
        }
      })
    }
  }

};

const handleSearch = (query) => {
  const originalList = [...props.listAlternatif];

  listAlternatifs.value = originalList.filter((value) => {
    return value.nama.trim().toLowerCase().includes(query.toLowerCase());
  });

  nextTick(() => {
    props.listSmarter.forEach((e) => {
      const selectElement = document.querySelector(`#alr${e.alternatif_id} #kriteria${e.kriteria_id} select`);
      if (selectElement) {
        selectElement.value = `${e.kriteria_id},${e.sub_kriteria_id}`;
      }
    });
  })
}
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
              class="text-start max-md:text-center lg:text-heading4-medium text-body-semibold dark:text-gray-300 text-gray-800 pb-2">
              Cari Alternatif :
            </p>
            <SearchInput label="Alternatif" @search="handleSearch" />
          </div>
        </template>
        <template #table>
          <template v-for="alternatif in rankingList">
            <TableCrud :isSmarter="true" :list="alternatif.kriteria" :id="`alr${alternatif.id}`" :max-rank="1"
              errorMessage="Masukan Kriteria Terlebih Dahulu" class="lg:mx-4 lg:mb-4 lg:rounded-lg"
              wrapper="bg-content lg:m-2 my-2">
              <template #sub-table-header>
                <div class="flex flex-col md:flex-row justify-between p-4 text-center">
                  <p class="lg:text-heading3-bold text-heading3-bold my-3 text-gray-800 dark:text-gray-100">
                    {{ alternatif.nama }}
                  </p>
                  <div class="hidden flex-col justify-center items-center">
                    <img src="img/result.svg" width="35px">
                    <p class="font-semibold dark:text-blue-400">Sudah Terisi Semua</p>
                  </div>
                </div>
              </template>
              <template #thead-content>
                <tr>
                  <Thead class="px-3" :label="'Kriteria'" :sort="false" />
                  <Thead :label="'Pilih Sub Kriteria yang Sesuai'" :sort="false" />
                </tr>
              </template>

              <template #tbody-content>
                <tr v-for="(item, index) in alternatif.kriteria" class="t-row" :class="'kriteriaAlr' + alternatif.id">

                  <TData :label="item.nama" class="px-3" />

                  <TData class="px-3" :id="'kriteria' + item.id">
                    <select @change="handleSelectOption(alternatif.id)"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option value="">Choose a Sub Kriteria</option>
                      <template v-for="subkriteria in item.subkriteria">
                        <option :value="[item.id, subkriteria.id]">
                          {{ subkriteria.nama }}
                        </option>
                      </template>
                    </select>
                  </TData>
                </tr>
                <tr>
                  <TData></TData>
                  <TData>
                    <button @click="handleSaveRanking(alternatif.id)"
                      class="px-4 py-2 ms-auto mx-1 me-2 max-h-12 capitalize flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                      Save
                    </button>
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
