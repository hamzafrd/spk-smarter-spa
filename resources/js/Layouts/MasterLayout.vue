<script setup>
import { useThemeStore } from '@/store';

const store = useThemeStore()
store.isThemeDark && ($('body').addClass('dark'))
</script>

<template>
    <slot />
</template>
