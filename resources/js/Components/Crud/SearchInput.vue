<script setup>
import { ref } from 'vue';

const props = defineProps({
  label: null,
  isEdit: null,
});
const emit = defineEmits(['search']);

const query = ref('');
const handleSearch = () => {
  emit('search', query.value);
};

const clearQuery = () => {
  query.value = '';
};

defineExpose({ clearQuery });
</script>
<template>
  <div class="w-full">
    <form class="flex items-center">
      <label for="simple-search" class="sr-only">Search {{ label }}</label>
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
          v-model="query"
          @input="handleSearch()"
          :disabled="isEdit"
          class="bg-primary-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
          :placeholder="
            isEdit
              ? 'Kembali ke awal untuk melakukan pencarian'
              : 'Search ' + label
          "
        />
      </div>
    </form>
  </div>
</template>
