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
    :id="`dropdownDotsButton${id}`"
    :data-dropdown-toggle="`dropdownDots${id}`"
    class="inline-flex items-center text-start p-2 text-sm font-medium text-gray-900 bg-white rounded-lg hover:bg-primary-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
    type="button"
  >
    <svg
      class="w-5 h-5"
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      fill="currentColor"
      viewBox="0 0 16 3"
    >
      <path
        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"
      />
    </svg>
  </button>

  <!-- Dropdown menu -->
  <div
    :id="`dropdownDots${id}`"
    class="z-10 hidden overflow-hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-32 dark:bg-gray-700 dark:divide-gray-600"
  >
    <ul
      class="text-sm text-gray-700 dark:text-gray-200"
      :aria-labelledby="`dropdownDotsButton${id}`"
    >
      <slot />
    </ul>
  </div>
</template>
