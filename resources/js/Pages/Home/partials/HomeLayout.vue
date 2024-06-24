<script setup>
import MasterLayout from '@/Layouts/MasterLayout.vue';
</script>

<template>
  <MasterLayout>
    <div class="min-h-screen dark:bg-gray-900 bg-[#f7f4ed] overflow-hidden">
      <slot />
    </div>
  </MasterLayout>
</template>
