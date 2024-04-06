<script setup>
import { useThemeStore } from '@/store';
import { initFlowbite } from 'flowbite';
import { onMounted } from 'vue';

onMounted(() => initFlowbite());
useThemeStore().isThemeDark && ($('body').addClass('dark'))
</script>

<template>
    <slot />
</template>
