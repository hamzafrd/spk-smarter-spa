<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  label: {
    type: String,
    default: '',
  },
  length: {
    type: Number || String,
    default: 0,
  },
});
const label = props.label.replace(/\s+/g, '').toLowerCase();
const imgLabel =
  label == 'subkriteria' ? 'kriteria_sub' : label == 'hasil' ? 'result' : label;

const imgDark = `img/${imgLabel}-dark.svg`;
const imgLight = `img/${imgLabel}.svg`;
const link = `${label == 'hasil' ? 'hasil-smarter' : label}.index`;
</script>
<template>
  <Link
    :href="route(link)"
    class="group/card block max-w-sm p-6 bg-primary-50 border border-gray-200 rounded-lg shadow hover:bg-primary-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
  >
    <div class="flex justify-between">
      <h5
        class="mb-2 text-5xl font-bold tracking-tight text-gray-900 dark:text-white"
      >
        {{ length }}
      </h5>
      <img
        :src="imgDark"
        :alt="label"
        class="w-14 h-14 opacity-50 hidden dark:block group-hover/card:opacity-100 group-focus/card:opacity-100"
      />
      <img
        :src="imgLight"
        :alt="label"
        class="w-14 h-14 opacity-50 dark:hidden group-hover/card:opacity-100 group-focus/card:opacity-10"
      />
    </div>
    <p class="font-norma text-start text-lg text-gray-700 dark:text-gray-400">
      {{ props.label }}
    </p>
  </Link>
</template>
