<script setup>
import CreateModal from './CreateModal.vue';
import DeleteAllModal from './DeleteAllModal.vue';
import DeleteModal from './DeleteModal.vue';
import MainModal from './MainModal.vue';
import ReadModal from './ReadModal.vue';
import SavePosisiModal from './SavePosisiModal.vue';
import UpdateModal from './UpdateModal.vue';


defineProps({
    kriteriaList: {
        type: Array,
        default: null
    },
})
</script>
<template>
    <div class="h-full">
        <MainModal :kriteria-list="kriteriaList" />
        <CreateModal :kriteria-list="kriteriaList" />
        <template v-if="kriteriaList.length">
            <UpdateModal />
            <DeleteAllModal />
            <ReadModal />
            <DeleteModal />
            <SavePosisiModal />
        </template>
    </div>
</template>
