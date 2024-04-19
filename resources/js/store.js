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

    category: null,
    dataList: [],
    subKriteriaList: [],

    kriteria: {
      nama: '',
      rank: '',
      bobot: '',
    },

    subKriteria: {
      nama: '',
      rank: '',
      bobot: '',
    },

    massEdit: false,
    showBobot: false,

    sortState: ['normal', 'desc', 'asc'],
    sortValue: 'normal',
    currSort: 0,

    modalName: '',

    queryKriteria: '',
    searchTimeout: null,
  }),

  actions: {
    loadList(category) {
      try {
        router.get(route(`${category}.index`));
      } catch (error) {
        console.error(error.response);
      }
    },

    async loadListSpa() {
      try {
        const response = await axios.get(route('api.dataList'));
        this.dataList = response.data.updatedData;
      } catch (error) {
        console.error(error.response);
      }
    },

    async updatePositions() {
      try {
        const response = await axios.put('/updkriteria', {
          listKriteria: this.dataList,
          bobot: this.getBobot,
        });
        this.dataList = response.data.updatedData;
      } catch (error) {
        console.error('Error saving positions:', error);
      }
    },

    /**
     * Handles different actions based on the 'params' value.
     *
     * @param {string} params - The type of action to perform ('store', 'update', 'delete', 'deleteAll')
     * @param {number} maxValue - The maximum value to set
     * @param {string} category - The category for the action
     */
    submitForm(params, maxValue, category, id) {
      switch (params) {
        case 'store':
          this.form.rank.max = maxValue;
          this.form.post(route(category + '.store'), {
            onSuccess: () => {
              this.form.nama = '';
              this.form.rank.value = '';
              this.loadList(category);
              this.toggleModal('createProductModal' + id);
            },
          });
          break;
        case 'update':
          this.form.rank.max = maxValue;
          this.form.put(route(category + '.update', this[category].id), {
            onSuccess: () => {
              this.form.nama = '';
              this.form.rank.value = '';
              this.loadList(category);
              this.toggleModal('updateProductModal' + id);
            },
          });
          break;
        case 'delete':
          this.form.delete(route(category + '.destroy', this[category].id), {
            onSuccess: () => {
              this.loadList(category);
              this.toggleModal('deleteModal');
            },
          });
          break;
        case 'deleteAll':
          this.form.delete(route(category + '.destroyAll'), {
            onSuccess: () => {
              this.loadList(category);
              this.toggleModal('deleteAllModal');
            },
          });
          break;

        default:
          console.error('not yet implemented');
          break;
      }
    },

    moveUp(index) {
      const item = this.dataList.splice(index, 1)[0];
      this.dataList.splice(index - 1, 0, item);
    },

    moveDown(index) {
      const item = this.dataList.splice(index, 1)[0];
      this.dataList.splice(index + 1, 0, item);
    },

    moveRank(index, el, isUp) {
      if (isUp) {
        el[0].innerHTML =
          el[0].innerHTML != index
            ? `<s>${el[0].innerHTML}</s> -> ${index}`
            : index;
      } else {
        el[0].innerHTML =
          el[0].innerHTML != index + 2
            ? `<s>${el[0].innerHTML}</s> -> ${index + 2}`
            : index + 2;
      }

      el[1].innerHTML =
        el[1].innerHTML != index + 1
          ? `<s>${el[1].innerHTML}</s> -> ${index + 1}`
          : index + 1;
    },

    moveListItem(index, direction) {
      const currentEl = document.getElementById('kriteria' + index);
      const prevEl = document.getElementById('kriteria' + (index - 1));
      const nextEl = document.getElementById('kriteria' + (index + 1));
      const rankEl = currentEl.querySelector('.rankKriteria');
      const delay = 200;

      const toggleClass = (el) => el.classList.toggle('bg-primary-700/50');

      toggleClass(currentEl);

      setTimeout(() => {
        toggleClass(currentEl);

        if (direction === 'up') {
          const prevRankEl = prevEl.querySelector('.rankKriteria');
          toggleClass(prevEl);

          setTimeout(() => {
            toggleClass(prevEl);
            this.moveRank(index, [prevRankEl, rankEl], true);
          }, delay);

          this.moveUp(index);
        } else {
          const nextRankEl = nextEl.querySelector('.rankKriteria');
          toggleClass(nextEl);
          this.moveDown(index);

          setTimeout(() => {
            toggleClass(nextEl);
            this.moveRank(index, [nextRankEl, rankEl]);
          }, delay);
        }
      }, delay);
    },

    setKriteria(item) {
      this.kriteria = item;
      this.form.nama = this.kriteria.nama;
      this.form.rank.value = this.kriteria.rank;
      this.form.rank.oldValue = this.kriteria.rank;
    },

    setSubKriteriaList(itemList) {
      this.subKriteriaList = itemList;
    },
    resetForm() {
      this.form.reset();
      this.form.errors = '';
    },
    toggleModal(modalName) {
      console.log(modalName);
      this.modalName = modalName;
      this.getModal.toggle();
    },

    sortList(params) {
      const valueName = params == 'keterangan' ? 'nama' : 'rank';
      this.sortValue = valueName;

      // Jika valuenya 'nama' maka terdapat 3 sort state
      if (this.sortValue == 'nama')
        this.currSort = (this.currSort + 1) % this.sortState.length;
      else this.currSort = (this.currSort + 1) % 2;
    },

    initLib() {
      if (this.searchTimeout) clearTimeout(this.searchTimeout);
      if (this.filteredList.length > 0)
        this.searchTimeout = setTimeout(() => {
          initFlowbite();
        }, 500);
    },
  },

  getters: {
    getBobot() {
      const list = [];
      const n = this.dataList.length;
      let valueNow = 0;
      for (let i = 0; i < n; i++) {
        valueNow += 1 / (n - i) / n;
        list.push(valueNow.toFixed(3));
      }

      return list.reverse();
    },

    getModal(state) {
      return new Modal(document.getElementById(state.modalName));
    },

    filteredList(state) {
      let filteredList = state.dataList.length > 0 ? [...state.dataList] : [];

      const stateSort = this.sortState[this.currSort];

      if (stateSort != 'normal') {
        filteredList = filteredList.sort((a, b) => {
          if (state.sortValue == 'nama') {
            const A = a.nama.toUpperCase();
            const B = b.nama.toUpperCase();
            const desc = A < B ? 1 : A > B ? -1 : 0;
            const asc = A < B ? -1 : A > B ? 1 : 0;
            return stateSort == 'asc' ? asc : desc;
          } else {
            return b.rank - a.rank;
          }
        });
      }

      if (state.queryKriteria.trim()) {
        const searchQuery = state.queryKriteria.trim().toLowerCase();
        filteredList = filteredList.filter((value) => {
          return value.nama.trim().toLowerCase().includes(searchQuery);
        });
      }

      return filteredList;
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
