<script setup>
import IndexCrudTable from '@/Components/Crud/IndexCrudTable.vue';
import TableCrud from '@/Components/Crud/TableCrud.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Thead from '@/Components/Crud/Thead.vue';
import TData from '@/Components/Crud/TData.vue';

const props = defineProps({
  listHasil: {
    type: Array,
    default: [],
  },
});
</script>

<template>

  <Head title="Kriteria" />

  <AuthenticatedLayout>
    <section class="h-full bg-content">
      <IndexCrudTable>
        <template #header>
          <p class="text-heading1-bold">Hasil Rekomendasi</p>
        </template>

        <template #table>
          <TableCrud id="main" :list="props.listHasil" :class="'lg:mx-4 lg:mb-4 lg:rounded-lg'">
            <template #thead-content>
              <tr>
                <Thead :label="'Altenatif'" />
                <Thead :label="'Keterangan'" />
                <Thead :label="'Bobot'" />
                <Thead :label="'Ranking'" />
              </tr>
            </template>

            <template #tbody-content>
              <tr v-for="(item, index) in props.listHasil" class="t-row" :id="'altenatif' + index">
                <TData :label="'A' + (index + 1)" />

                <TData :label="item.nama" />
                <TData :label="item.hasilperhitungan[0].total.toFixed(3)" />
                <TData :label="index + 1" />


              </tr>
            </template>
          </TableCrud>
        </template>

      </IndexCrudTable>
    </section>
  </AuthenticatedLayout>
</template>
