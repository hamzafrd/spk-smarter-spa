<script setup>
import { useThemeStore } from '@/store';

const store = useThemeStore()
</script>
<template>
    <div class="toggle-container" :class="!store.isThemeDark && 'lightmode'">
        <div class="theme__toggler-container" @click="store.toggleTheme()">
            <div class="theme__toggler">
                <span class="dot"></span>
            </div>
        </div>
    </div>
</template>
resources/data/store
