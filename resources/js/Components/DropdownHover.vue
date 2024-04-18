<script setup>
defineProps({
  id: {
    type: String,
    default: null,
  },
});
</script>
<template>
  <button
    :id="`dropdownHoverButton${id}`"
    :data-dropdown-toggle="`dropdownHover${id}`"
    class="dropdownBtn"
    type="button"
  >
    Pengaturan Tabel
    <svg
      class="w-2.5 h-2.5 ms-3"
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 10 6"
    >
      <path
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="m1 1 4 4 4-4"
      />
    </svg>
  </button>

  <!-- Dropdown menu -->
  <div
    :id="`dropdownHover${id}`"
    class="z-10 overflow-hidden hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
  >
    <ul :aria-labelledby="`dropdownHoverButton${id}`">
      <slot name="contentTop" />
    </ul>
    <slot />
  </div>
</template>
