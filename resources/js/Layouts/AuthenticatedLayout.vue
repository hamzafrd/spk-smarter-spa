<script setup>
import NavbarAside from '@/Components/NavAside.vue';
import NavBarTop from '@/Components/NavTop.vue';
import MasterLayout from './MasterLayout.vue';
</script>

<template>
    <MasterLayout>
        <div class="dark:bg-gray-900 min-h-screen bg-gray-100">
            <header class="lg:hidden dark:bg-gray-800 dark:border-gray-700  bg-white border-b border-gray-100">
                <NavBarTop />
            </header>
            <main class="dark:bg-gray-900 flex max-md:block bg-gray-100">
                <NavbarAside />

                <div class="max-w-full flex-1 overflow-auto px-1">
                    <slot />
                </div>
            </main>
        </div>

    </MasterLayout>
</template>
