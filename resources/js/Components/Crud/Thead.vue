<script setup>
import SortArrow from '../SortArrow.vue';

defineProps({
  label: null,
  sort: {
    type: Boolean,
    default: true,
  },
});
</script>
<template>
  <th scope="col">
    <div class="flex items-center justify-center px-5 py-3">
      <span class="max-md:text-sm">{{ label }}</span>
      <SortArrow v-if="sort" :label="label" />
    </div>
  </th>
</template>
