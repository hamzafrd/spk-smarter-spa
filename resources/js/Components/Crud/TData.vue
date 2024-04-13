<script setup>
defineProps({
  label: null,
});
</script>
<template>
  <td
    scope=" row"
    class="px-1 py-3 font-medium text-gray-700 whitespace-nowrap dark:text-gray-300"
  >
    <slot />
    {{ label }}
  </td>
</template>
