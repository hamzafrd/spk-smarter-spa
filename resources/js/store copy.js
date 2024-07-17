import { router, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { Dropdown, Modal, initFlowbite } from 'flowbite';
import { defineStore } from 'pinia';

export const useFormStore = defineStore('forms', {
  state: () => ({
    form: useForm({
      nama: '',
      rank: {
        min: 1,
        max: null,
        oldValue: null,
        value: null,
      },
      id: null,
    }),
    modalName: '',
  }),

  actions: {
    loadList(category) {
      try {
        router.get(route(`${category}.index`));
      } catch (error) {
        console.error(error.response);
      }
    },

    submitForm(params, maxValue, category, id) {
      switch (params) {
        case 'store':
          this.form.rank.max = maxValue;
          this.form.post(route(category + '.store'), {
            onSuccess: () => {
              this.form.nama = '';
              this.form.rank.value = '';
              this.toggleModal('createProductModal' + id);
              this.loadList(category);
            },
          });
          break;

        default:
          console.error('not yet implemented');
          break;
      }
    },

    toggleModal(modalName) {
      console.log(modalName);
      this.modalName = modalName;
      this.getModal.toggle();
    },
  },

  getters: {
    getModal(state) {
      return new Modal(document.getElementById(state.modalName));
    },
  },
});

export const useSideNavStatus = defineStore('sidenav', {
  state: () => ({
    status: true,
  }),

  actions: {
    toggle() {
      this.status = !this.status;
    },
  },

  getters: {
    isExtended: (state) => (!state.status ? 'opacity-0' : 'opacity-1'),
  },
});

export const useThemeStore = defineStore('theme', {
  state: () => ({
    isThemeDark:
      localStorage.theme === 'dark' ||
      (!('theme' in localStorage) &&
        window.matchMedia('(prefers-color-scheme: dark)').matches),
  }),

  actions: {
    toggleTheme() {
      this.isThemeDark = !this.isThemeDark;

      if (this.isThemeDark) {
        localStorage.theme = 'dark';
        $('body').addClass('dark');
      } else {
        localStorage.theme = 'light';
        $('body').removeClass('dark');
      }
    },
  },

  getters: {
    getTheme: (state) => state.isThemeDark,
  },
});
