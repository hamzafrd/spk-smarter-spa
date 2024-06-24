<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import MasterLayout from './MasterLayout.vue';
import NavThemeToggle from '@/Components/NavThemeToggle.vue';
import axios from 'axios';


const logout = () => {
  window.location.href = '/';
}
</script>

<template>
  <MasterLayout>
    <div class="sm:justify-center sm:pt-0 dark:bg-gray-900 flex flex-col items-center min-h-screen pt-6 bg-primary-100">
      <div class="flex items-center gap-3">
        <div>
          <button @click="logout">
            <ApplicationLogo class="text-gray-500 fill-current" />
          </button>
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
        class="sm:max-w-md dark:bg-gray-800 sm:rounded-lg w-full px-6 py-4 mt-6 overflow-hidden bg-primary-50 shadow-md">
        <slot />
      </div>
    </div>
  </MasterLayout>
</template>
