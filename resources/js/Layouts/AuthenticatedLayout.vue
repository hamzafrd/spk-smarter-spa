<script setup>
import NavBarTop from '@/Components/NavTop.vue';
import NavbarAside from '@/Components/NavAside.vue'
import MasterLayout from './MasterLayout.vue';
</script>

<template>
    <MasterLayout>
        <div class="dark:bg-gray-900 min-h-screen bg-gray-100">
            <header class="max-md:block dark:bg-gray-800 dark:border-gray-700 hidden bg-white border-b border-gray-100">
                <NavBarTop />
            </header>
            <main class="max-md:block dark:bg-gray-900 flex min-h-screen bg-gray-100">
                <NavbarAside />

                <div class="max-w-7xl sm:px-6 lg:px-8 z-1  flex-1 pt-6">
                    <slot />
                </div>
            </main>
        </div>

    </MasterLayout>
</template>
