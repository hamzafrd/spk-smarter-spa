<script setup>
import { useFormStore } from '@/store';
import { Link } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';
import SecondaryButton from '../SecondaryButton.vue';

const store = useFormStore()

const { setKriteria, updatePositions, toggleModal, moveListItem, loadList } = store
const { kriteriaList, massEdit, showBobot } = storeToRefs(store)


const tableBase = 'px-1 py-3';
const tableHead = 'px-5 py-3';
</script>
<template lang="html">
    <section class="bg-gray-50 dark:bg-gray-900  antialiased ">
        <div class="mx-auto max-w-screen-xl ">

            <div class="bg-white dark:bg-gray-800 relative shadow-md">

                <!-- Header -->
                <div class="flex justify-start flex-col md:flex-row md:justify-between">
                    <p class="text-heading1-bold dark:text-white p-1 md:p-5">Kriteria </p>

                    <p class="text-heading2-semibold dark:text-white p-1 md:p-5">Total Kriteria : {{ kriteriaList.length
                        }}
                    </p>
                </div>

                <!-- Table -->
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">

                    <!-- Table Left (Search Bar) -->
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search" required="true">
                            </div>
                        </form>
                    </div>

                    <!-- Table Right -->
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button" id="createProductModalButton"
                            @click="toggleModal('createProductModal', true)" data-modal-target="createProductModal"
                            data-modal-toggle="createProductModal"
                            class="p-2 flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Tambah Kriteria
                        </button>
                        <button v-if="massEdit" @click="updatePositions()" type="button"
                            class="p-2 flex items-center justify-center text-white bg-primary-700  hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            Save Posisi Kriteria
                        </button>

                        <!-- Dropdown -->
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                type="button">
                                <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                                Pengaturan Tabel
                            </button>
                            <div id="actionsDropdown"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="actionsDropdownButton">
                                    <li>
                                        <a href="#" @click="
                                            massEdit = !massEdit,
                                            loadList()
                                            "
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <template v-if="!massEdit">
                                                Atur Posisi
                                            </template>
                                            <template v-else>
                                                Kembali Ke Semula
                                            </template>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" v-if="!massEdit" @click="showBobot = !showBobot"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <template v-if="!showBobot">
                                                Tampilkan Bobot
                                            </template>
                                            <template v-else>
                                                Sembunyikan Bobot
                                            </template>
                                        </a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#" data-modal-target="deleteAllModal"
                                        @click="toggleModal('deleteAllModal', true)"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                        all</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <p class="text-base-semibold dark:text-gray-600 md:hidden"> Scroll ke kanan untuk melihat tabel >>>
                    </p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 child:text-center">
                            <tr>
                                <th scope="col" :class="tableHead">Kriteria</th>
                                <th scope="col" :class="tableHead">Keterangan</th>
                                <th scope="col" :class="tableHead">Peringkat</th>
                                <th v-if="!massEdit && showBobot" scope="col" :class="tableHead">Bobot</th>
                                <th scope="col" :class="tableHead">Sub Kriteria</th>
                                <th scope="col" :class="tableHead">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="child:text-center">
                            <tr class="border-b dark:border-gray-700" v-for="(kriteria, index) in kriteriaList"
                                :id="'kriteria' + index">
                                <th scope=" row" :class="tableBase"
                                    class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ 'C' + (index + 1) }}</th>
                                <td :class="tableBase">{{ kriteria.nama }}</td>
                                <td :class="tableBase" class="rankKriteria">{{ kriteria.rank }}</td>
                                <td v-if="!massEdit && showBobot" :class="tableBase">{{ kriteria.bobot }}</td>
                                <td :class="tableBase">
                                    <Link href="#"
                                        class="flex items-center justify-center text-primary-600 dark:text-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z">
                                        </path>
                                        <path
                                            d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z">
                                        </path>
                                    </svg>
                                    Lihat Sub Kriteria
                                    </Link>
                                </td>
                                <!-- Aksi -->
                                <td :class="tableBase" class="flex justify-center">
                                    <div class="move-buttons" v-if="massEdit">
                                        <SecondaryButton @click="moveListItem(index, 'up')" :disabled="index === 0">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                            </svg>
                                        </SecondaryButton>
                                        <SecondaryButton @click="moveListItem(index, 'down')"
                                            :disabled="index === kriteriaList.length - 1">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 19V5m0 14-4-4m4 4 4-4" />
                                            </svg>
                                        </SecondaryButton>
                                    </div>

                                    <!-- Button Dropdown -->
                                    <button :id="kriteria.nama + kriteria.id"
                                        :data-dropdown-toggle="kriteria.nama + kriteria.id + 'dropdown'"
                                        :class="massEdit ? 'hidden' : 'block'"
                                        class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div :id="kriteria.nama + kriteria.id + 'dropdown'"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm" :aria-labelledby="kriteria.nama + kriteria.id">
                                            <li>
                                                <button type="button" data-modal-target="updateProductModal"
                                                    data-modal-toggle="updateProductModal"
                                                    @click="setKriteria(kriteria), toggleModal('updateProductModal', true)"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-modal-target="readProductModal"
                                                    data-modal-toggle="readProductModal" @click="setKriteria(kriteria)"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                    Preview
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-modal-target="deleteModal"
                                                    data-modal-toggle="deleteModal"
                                                    @click="setKriteria(kriteria), toggleModal('deleteModal', true)"
                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                                                    <svg class="w-6 h-6 mr-2" viewbox="0 0 14 15" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            fill="currentColor"
                                                            d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</template>
