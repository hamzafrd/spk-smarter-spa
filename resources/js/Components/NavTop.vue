<script setup>
import { linkNav } from '@/constant';
import { useSideNavStatus } from '@/store';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import ApplicationLogo from './ApplicationLogo.vue';
import Dropdown from './Dropdown.vue';
import DropdownLink from './DropdownLink.vue';
import NavLink from './NavLink.vue';
import NavThemeToggle from './NavThemeToggle.vue';
import ResponsiveNavLink from './ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);
const darkNavbar =
  'dark:bg-gray-800 dark:border-gray-700 bg-primary-50 border-b border-gray-100';


</script>

<template>
  <div class="max-w-7xl sm:px-6 lg:px-8 px-4 mx-auto" :class="darkNavbar">
    <div class="flex justify-between h-16">
      <!-- Logo -->
      <div class="shrink-0 flex items-center">
        <Link :href="route('dashboard.index')">
        <ApplicationLogo />
        </Link>
        <div class="ps-4">
          <p class="dark:text-white text-base-semibold">SPK SMARTER</p>
          <p class="dark:text-white text-small-regular">Tanah Perumahan</p>
        </div>
      </div>

      <!-- Toggle & Dropdown -->
      <div class="flex items-center">
        <div class="flex items-center">
          <NavThemeToggle />
          <!-- Dropdown -->
          <div class="sm:flex sm:items-center hidden">
            <!-- Settings Dropdown -->
            <div class="ms-3 relative">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button type="button"
                      class="dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none inline-flex items-center px-3 py-2 font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-primary-50 border border-transparent rounded-md">
                      {{ $page.props.auth.user.name }}

                      <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd" />
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

        <!-- Hamburger -->
        <div class="-me-2 ms-2 sm:hidden flex items-center">
          <button @click="showingNavigationDropdown = !showingNavigationDropdown"
            class="dark:text-gray-500 dark:hover:text-gray-400 dark:hover:bg-gray-900 dark:focus:bg-gray-900 dark:focus:text-gray-400 hover:text-gray-500 hover:bg-primary-100 focus:outline-none focus:bg-primary-100 focus:text-gray-500 inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md">
            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path :class="{
                hidden: showingNavigationDropdown,
                'inline-flex': !showingNavigationDropdown,
              }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              <path :class="{
                hidden: !showingNavigationDropdown,
                'inline-flex': showingNavigationDropdown,
              }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{
    block: showingNavigationDropdown,
    hidden: !showingNavigationDropdown,
  }" class="sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
      <template v-for="link in linkNav" :key="link.label">
        <ResponsiveNavLink :href="route(link.route)" :active="route().current(link.route)">
          {{ link.label }}
        </ResponsiveNavLink>
      </template>
    </div>

    <!-- Responsive Settings Options -->
    <div class="dark:border-gray-600 pt-4 pb-1 border-t border-gray-200">
      <div class="px-4">
        <div class="dark:text-gray-200 text-base font-medium text-gray-800">
          {{ $page.props.auth.user.name }}
        </div>
        <div class="font-medium text-gray-500">
          {{ $page.props.auth.user.email }}
        </div>
      </div>

      <div class="mt-3 space-y-1">
        <ResponsiveNavLink :href="route('profile.edit')">
          Profile
        </ResponsiveNavLink>
        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
          Log Out
        </ResponsiveNavLink>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav id="nav" class="max-sm:hidden flex justify-center" :class="darkNavbar">
    <template v-for="link in linkNav" :key="link.label">
      <NavLink :href="route(link.route)" :active="route().current(link.route)" :img="link.imgURL" :label="link.label">
      </NavLink>
    </template>
  </nav>
</template>
