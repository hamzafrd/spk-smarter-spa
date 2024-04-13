<script setup>
import { Link, router } from '@inertiajs/vue3';
</script>
<template>
  <Link
    :href="route('kriteria.index')"
    class="inline-flex h-12 justify-between items-center py-1 px-1 pr-4 mb-7 text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600"
    role="alert"
  >
    <div
      class="flex flex-shrink-0 bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3 h-full"
    >
      <img src="img/kriteria-dark.svg" alt="logo-kriteria" />
    </div>
    <span class="font-medium max-sm:text-sm"
      >Tambah kriteria tanah perumahan sekarang</span
    >
    <svg
      class="ml-2 w-5 h-5 max-sm:w-4 max-sm:h-4"
      fill="currentColor"
      viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        fill-rule="evenodd"
        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
        clip-rule="evenodd"
      ></path>
    </svg>
  </Link>
</template>
