<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useFormStore } from '@/store';
import { Head } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';
import DashboardPill from '@/Components/DashboardPill.vue';
import CardInstruction from '@/Components/CardInstruction.vue';
const props = defineProps({
  kriteriaList: {
    type: Array,
    default: null,
  },
  alternatifList: {
    type: Array,
    default: null,
  },
});

useFormStore().kriteriaList = props.kriteriaList;
const subkriteriaLen = props.kriteriaList.reduce((result, current) => {
  return result + current.subkriteria.length;
}, 0);
const hasilLen = props.kriteriaList.reduce((result, current) => {
  return result + current.smarter.length;
}, 0);
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <section>
      <div class="py-8 px-4 text-center">
        <h1
          class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-heading1-bold dark:text-white"
        >
          Sistem Pendukung Keputusan
        </h1>
        <p
          class="text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400"
        >
          Pemilihan Tanah Perumahan
        </p>

        <!-- card -->
        <div class="my-8 grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-4">
          <Card :length="kriteriaList.length" label="Kriteria" />
          <Card :length="subkriteriaLen" label="Sub Kriteria" />
          <Card :length="alternatifList.length" label="Alternatif" />
          <Card :length="hasilLen" label="Hasil" />
        </div>

        <DashboardPill />

        <div class="table-container rounded-t-lg">
          <h1
            class="t-head capitalize py-2 tracking-tight leading-none text-gray-900 md:text-xl dark:text-white"
          >
            Intruksi Penggunaan :
          </h1>

          <div class="py-8 px-4 lg:px-6 grid lg:grid-cols-4 grid-cols-2">
            <CardInstruction
              number="1"
              title="Masukan Kriteria"
              desc="Masukan kriteria tanah perumahan pada halaman kriteria "
            />
            <CardInstruction
              number="2"
              title="Masukan Sub Kriteria"
              desc="Masukan sub kriteria dari kriteria yang telah dibuat pada halaman sub kriteria "
            />
            <CardInstruction
              number="3"
              title="Masukan Alternatif"
              desc="Masukan alternatif/tanah perumahan yang akan dipilih pada halaman alternatif "
            />
            <CardInstruction
              number="4"
              title="Melihat Hasil"
              desc="Lihat hasil tanah perumahan terbaik yang telah diproses dengan  metode SMARTER"
            />
          </div>
        </div>

        <p
          class="mt-8 text-lg font-normal text-gray-500 lg: sm:px-16 xl:px-48 dark:text-gray-400"
        >
          &copy; 2024 Hamza Firdaus
        </p>
      </div>
    </section>
  </AuthenticatedLayout>
</template>
