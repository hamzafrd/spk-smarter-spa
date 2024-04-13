<script setup>
defineProps({
  title: {
    type: String,
    default: null,
  },
  desc: {
    type: String,
    default: null,
  },
  number: {
    type: String || Number,
    default: null,
  },
});
</script>
<template>
  <div class="flex flex-col items-center gap-4 p-2">
    <div
      class="flex justify-center items-center rounded-full w-10 h-10 bg-primary-100 dark:bg-primary-900"
    >
      <p class="text-primary-600 dark:text-primary-300 text-heading3-bold">
        {{ number }}
      </p>
    </div>
    <h3 class="text-xl font-bold dark:text-white">{{ title }}</h3>
    <p class="text-gray-500 dark:text-gray-400">{{ desc }}</p>
  </div>
</template>
