<script setup>
import { useFormStore } from '@/store';
import { storeToRefs } from 'pinia';
import SecondaryButton from '../SecondaryButton.vue';

const store = defineProps({
    kriteriaList: {
        type: Array,
        default: null
    },
})

const storePinia = useFormStore()
const { setKriteria, updatePositions, toggleModal, moveListItem, loadList, resetForm } = storePinia
const { massEdit, showBobot, kriteriaList, searchQuery, filteredList } = storeToRefs(storePinia)
kriteriaList.value = store.kriteriaList

const tableBase = 'px-1 py-3';
const tableHead = 'px-5 py-3';
</script>
<template lang="html">

    <section
        class="h-full flex flex-col bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 lg:rounded-lg shadow-sm antialiased relative">
        <!-- Header -->
        <div
            class="flex justify-start flex-col lg:items-end md:flex-row md:justify-between dark:text-white ms-4 lg:m-4">
            <p class="text-heading1-bold">Kriteria </p>

            <p class="text-heading2-semibold">Total Kriteria : {{ kriteriaList.length
                }}
            </p>
        </div>

        <!-- Table Header -->
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">

            <!-- Left (Search Bar) -->
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search" v-model="searchQuery" :disabled="massEdit"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            :placeholder="massEdit ? 'Kembali ke awal untuk melakukan pencarian' : 'search'"
                            required="true">
                    </div>
                </form>
            </div>

            <!-- Right -->
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <button type="button" id="createProductModalButton"
                    @click="toggleModal('createProductModal'), resetForm()" data-modal-target="createProductModal"
                    data-modal-toggle="createProductModal"
                    class="px-3 py-2 flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    <svg class="w-6 h-6 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    Tambah Kriteria
                </button>
                <button v-if="massEdit" @click="updatePositions()" type="button"
                    class="p-2 flex items-center justify-center text-white bg-primary-700  hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg t:ext-sm tableBase dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    Save Posisi Kriteria
                </button>


                <!-- Dropdown -->
                <div v-if="kriteriaList.length" class="flex items-center space-x-3 w-full md:w-auto">
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
                                <a href="#" v-if="!massEdit" @click="massEdit = !massEdit, searchQuery = '', loadList()"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Atur Posisi
                                </a>
                                <a href="#" :class="massEdit ? 'block' : 'hidden'" type="button"
                                    @click="toggleModal('simpanPosisiModal')"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Kembali ke awal
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
                            <a href="#" data-modal-target="deleteAllModal" @click="toggleModal('deleteAllModal')"
                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                all</a>
                        </div>
                    </div>
                </div>

            </div>
            <p class="text-base-semibold dark:text-gray-600 text-gray-300 md:hidden"> Scroll ke kanan untuk
                melihat tabel >>>
            </p>
        </div>

        <!-- Table Content -->
        <div v-if="kriteriaList.length"
            class="overflow-x-auto  lg:mx-4 lg:mb-4 lg:rounded-md border dark:border-gray-600 border-gray-300">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400 child:text-center">
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
                    <tr class="border-b dark:border-gray-700 " v-for="(item, index) in filteredList"
                        :id="'kriteria' + index">
                        <th scope=" row" :class="tableBase"
                            class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ 'C' + (index + 1) }}</th>
                        <td :class="tableBase">{{ item.nama }}</td>
                        <td :class="tableBase" class="rankKriteria">{{ item.rank }}</td>
                        <td v-if="!massEdit && showBobot" :class="tableBase">{{ item.bobot }}</td>
                        <td :class="tableBase">
                            <a href="#" class="flex items-center justify-center text-primary-600 dark:text-primary-500">
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
                            </a>
                        </td>
                        <!-- Aksi -->
                        <td :class="tableBase" class="flex justify-center">
                            <div class="move-buttons" v-if="massEdit">
                                <SecondaryButton @click="moveListItem(index, 'up')" :disabled="index === 0">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4" />
                                    </svg>
                                </SecondaryButton>
                                <SecondaryButton @click="moveListItem(index, 'down')"
                                    :disabled="index === kriteriaList.length - 1">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 19V5m0 14-4-4m4 4 4-4" />
                                    </svg>
                                </SecondaryButton>
                            </div>

                            <!-- Aksi Dropdown -->
                            <button :id="item.nama + item.id" :data-dropdown-toggle="item.nama + item.id + 'dropdown'"
                                :class="massEdit ? 'hidden' : 'block'"
                                class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                            <div :id="item.nama + item.id + 'dropdown'"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 border border-gray-200 dark:border-gray-700">
                                <ul class="py-1 text-sm" :aria-labelledby="item.nama + item.id">
                                    <li>
                                        <button type="button" data-modal-target="updateProductModal"
                                            data-modal-toggle="updateProductModal"
                                            @click="setKriteria(item), toggleModal('updateProductModal')"
                                            class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                            Edit
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" data-modal-target="readProductModal"
                                            data-modal-toggle="readProductModal" @click="setKriteria(item)"
                                            class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                            Lihat
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" data-modal-target="deleteModal"
                                            data-modal-toggle="deleteModal"
                                            @click="setKriteria(item), toggleModal('deleteModal')"
                                            class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                                            <svg class="w-6 h-6 text-red-500  mr-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
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

        <div v-else class="dark:text-gray-500 text-heading4-medium flex-1 flex items-center justify-center">
            <p>Masukan Data Kriteria dengan cara menekan tombol + Tambah Kriteria</p>
        </div>
    </section>
</template>
