<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import MasterLayout from './MasterLayout.vue';
import NavThemeToggle from '@/Components/NavThemeToggle.vue';
</script>

<template>
  <MasterLayout>
    <div
      class="sm:justify-center sm:pt-0 dark:bg-gray-900 flex flex-col items-center min-h-screen pt-6 bg-gray-100"
    >
      <div class="flex items-center gap-3">
        <div>
          <Link href="/">
            <ApplicationLogo class="text-gray-500 fill-current" />
          </Link>
        </div>
        <div>
          <h1 class="dark:text-white">SPK SMARTER</h1>
          <h2 class="dark:text-white">Pemilihan Tanah Perumahan</h2>
        </div>
        <div class="dark:bg-primary-color ms-5 p-1 bg-yellow-200 rounded-full">
          <NavThemeToggle />
        </div>
      </div>

      <div
        class="sm:max-w-md dark:bg-gray-800 sm:rounded-lg w-full px-6 py-4 mt-6 overflow-hidden bg-gray-50 shadow-md"
      >
        <slot />
      </div>
    </div>
  </MasterLayout>
</template>
