<script setup>
import { useFormStore } from '@/store';
import { storeToRefs } from 'pinia';
const props = defineProps({
  id: {
    type: String,
    default: null,
  },
});
const store = useFormStore();

const { kriteria } = storeToRefs(store);
</script>
<template>
  <div id="readProductModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
      <!-- Modal content -->
      <div class="relative p-4 bg-primary-50 rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between mb-4 rounded-t sm:mb-5">
          <div class="text-lg text-gray-900 md:text-xl dark:text-white">
            <h3 class="font-sans">Nama Kriteria :</h3>
            <p class="font-bold text-gray-500 dark:text-gray-400">
              {{ kriteria.nama }}
            </p>
          </div>
          <div>
            <button type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-target="readProductModal" data-modal-hide="readProductModal">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
        </div>
        <dl>
          <dt class="mb-2 font-sans leading-none text-gray-900 dark:text-white">
            Rank Kriteria :
          </dt>
          <dd class="mb-4 font-bold text-gray-500 sm:mb-5 dark:text-gray-400">
            {{ kriteria.rank }}
          </dd>
          <dt class="mb-2 font-sans leading-none text-gray-900 dark:text-white">
            Bobot ROC :
          </dt>
          <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
            {{ kriteria.bobot }}
          </dd>
        </dl>

      </div>
    </div>
  </div>
</template>
