<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
  },
  img: {
    type: Array,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
});

const classes = computed(() =>
  props.active
    ? 'flex items-center gap-2 px-6 max-md:px-4 pb-2 py-2.5 border-b-2  border-primary-400 dark:border-primary-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-primary-700 transition duration-150 ease-in-out'
    : 'flex items-center gap-2 px-6 max-md:px-4 pb-2 py-2.5 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-primary-300 dark:hover:primary-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out'
);
</script>

<template>
  <Link :href="href" :class="classes">
    <img
      v-if="props.img"
      :src="props.img[0]"
      :alt="'img-' + props.label"
      :id="props.label"
      class="dark:block hidden"
    />
    <img
      v-if="props.img"
      :src="props.img[1]"
      :alt="'img-' + props.label"
      :id="props.label"
      class="dark:hidden"
    />
    {{ label }}
  </Link>
</template>
