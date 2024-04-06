<script setup>
const props = defineProps({
    status: {
        type: Boolean,
    },
    isExtended: {
        type: String,
    },
});

</script>
<template lang="html">
    <!-- Toggle & Logo -->
    <div class="dark:bg-indigo-700 bg-indigo-300 flex flex-col gap-2 py-6 border-b border-gray-300/50"
        :class="!props.status ? '' : 'duration-1000 delay-[350ms]'">
        <!-- Logo -->
        <div class="overflow-hidden" :class="'transition-opacity ' + props.isExtended">
            <div class="shrink-0 justify-evenly flex items-center">
                <Link :href="route('dashboard.index')">
                <ApplicationLogo />
                </Link>
            </div>
            <div class="dark:text-white pt-3 text-center">
                <p class="dark:text-white text-base-semibold">SPK SMARTER</p>
                <p class="dark:text-white text-small-regular">Pemilihan Tanah Perumahan</p>
            </div>
        </div>

        <!-- Toggle -->
        <div class="flex items-center justify-center 2">
            <NavThemeToggle :class="props.isExtended" />
        </div>
    </div>
</template>
