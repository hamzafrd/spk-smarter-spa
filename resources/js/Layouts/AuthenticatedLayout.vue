<script setup>
import NavbarAside from '@/Components/NavAside.vue';
import NavBarTop from '@/Components/NavTop.vue';
import MasterLayout from './MasterLayout.vue';
</script>

<template>
  <MasterLayout>
    <div class="dark:bg-gray-900 min-h-screen bg-primary-100 flex flex-col lg:flex-row">
      <header class="lg:hidden dark:bg-gray-800 dark:border-gray-700 bg-primary-50 border-b border-gray-100">
        <NavBarTop />
      </header>
      <main class="flex-1 flex dark:bg-gray-900 bg-slate-200">
        <NavbarAside />

        <div class="flex-1 relative mx-2 my-1 max-lg:m-0 overflow-auto">
          <slot />
        </div>
      </main>
    </div>
  </MasterLayout>
</template>
