<script setup>
import { linkNav } from '@/constant';
import { useSideNavStatus } from '@/store';
import { Link } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia';
import ApplicationLogo from './ApplicationLogo.vue';
import Dropdown from './Dropdown.vue';
import DropdownLink from './DropdownLink.vue';
import NavLink from './NavLink.vue';
import NavThemeToggle from './NavThemeToggle.vue';

const store = useSideNavStatus();

const { toggle } = store;
const { status, isExtended } = storeToRefs(store);
</script>

<template>
  <aside
    class="w-52 hidden lg:flex shrink-0 dark:bg-gray-800 dark:border-r-dark-4 sticky top-0 left-0 z-20 flex-col justify-between h-screen bg-primary-50 border-r-1 shadow shadow-gray-400 dark:shadow-gray-500"
    :class="!status ? 'block w-[0]' : ''"
  >
    <!-- Hamburger -->
    <button
      @click="toggle()"
      :class="
        !status ? 'duration-500  transform  translate-x-12' : 'duration-0'
      "
      class="text-gray-700 dark:text-black dark:hover:text-gray-400 dark:hover:bg-secondary-color/50 hover:text-gray-200 hover:bg-primary-500 bg-primary-500/50 dark:bg-primary-100/50 absolute top-1 right-1 inline-flex items-center justify-center p-2 rounded-md"
    >
      <svg
        class="w-6 h-6"
        stroke="currentColor"
        fill="none"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"
        />
      </svg>
    </button>

    <div class="flex flex-col flex-1">
      <!-- Toggle & Logo -->
      <div
        class="dark:bg-indigo-700 bg-primary-300 flex flex-col gap-2 py-6 border-b border-gray-300/50"
        :class="!status ? '' : 'duration-1000 delay-[350ms]'"
      >
        <!-- Logo -->
        <div
          class="overflow-hidden"
          :class="'transition-opacity ' + isExtended"
        >
          <div class="shrink-0 justify-evenly flex items-center">
            <Link :href="route('dashboard.index')">
              <ApplicationLogo />
            </Link>
          </div>
          <div class="dark:text-white pt-3 text-center">
            <p class="dark:text-white text-base-semibold">SPK SMARTER</p>
            <p class="dark:text-white text-small-regular">
              Pemilihan Tanah Perumahan
            </p>
          </div>
        </div>

        <!-- Toggle -->
        <div class="flex items-center justify-center 2">
          <NavThemeToggle :class="isExtended" />
        </div>
      </div>

      <!-- SideBar -->
      <div
        class="flex flex-col flex-1 gap-4 overflow-hidden"
        :class="'transition-opacity ' + isExtended"
      >
        <div class="flex flex-col">
          <template v-for="link in linkNav" :key="link.label">
            <NavLink
              :href="route(link.route)"
              :active="route().current(link.route)"
              :img="link.imgURL"
              :class="'py-6'"
              :label="link.label"
            >
            </NavLink>
          </template>
        </div>

        <!-- Settings Dropdown -->
        <div class="sm:flex sm:items-center sm:justify-center hidden">
          <div class="relative">
            <Dropdown align="center" width="100%">
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none inline-flex items-center px-3 py-2 font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-primary-50 border border-transparent rounded-md"
                  >
                    Hello, {{ $page.props.auth.user.name }}

                    <svg
                      class="ms-2 -me-0.5 h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </button>
                </span>
              </template>

              <template #content>
                <DropdownLink :href="route('profile.edit')">
                  Profile
                </DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">
                  Log Out
                </DropdownLink>
              </template>
            </Dropdown>
          </div>
        </div>
      </div>
    </div>
  </aside>
</template>
