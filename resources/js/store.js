import { router, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { Dropdown, Modal } from 'flowbite';
import { defineStore } from 'pinia';

export const useFormStore = defineStore('forms', {
  state: () => ({
    formKriteria: useForm({
      nama: '',
      rank: {
        min: 1,
        max: null,
        oldValue: null,
        value: null,
      },
    }),
    kriteriaList: {
      type: Array,
      default: null,
    },

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
    modalBase: {
      type: Modal,
      default: null,
    },

    searchQuery: '',
    searchTimeout: null,
  }),

  actions: {
    loadList() {
      try {
        router.get('/kriteria');
      } catch (error) {
        console.error(error.response);
      }
    },

    async loadListSpa() {
      try {
        const response = await axios.get(route('api.listkriteria'));
        this.kriteriaList = response.data.updatedData;
      } catch (error) {
        console.error(error.response);
      }
    },

    async updatePositions() {
      try {
        const response = await axios.put('/updkriteria', {
          listKriteria: this.kriteriaList,
          bobot: this.getBobot,
        });
        this.kriteriaList = response.data.updatedData;
      } catch (error) {
        console.error('Error saving positions:', error);
      }
    },

    submitForm(params, maxValue) {
      switch (params) {
        case 'store':
          this.formKriteria.rank.max = maxValue;
          this.formKriteria.post(route('kriteria.store'), {
            onSuccess: () => {
              this.formKriteria.nama = '';
              this.formKriteria.rank.value = '';
              this.loadList();
              this.toggleModal('createProductModal');
            },
          });
          break;
        case 'update':
          this.formKriteria.rank.max = maxValue;
          this.formKriteria.put(route('kriteria.update', this.kriteria.id), {
            onSuccess: () => {
              this.formKriteria.nama = '';
              this.formKriteria.rank.value = '';
              this.loadList();
              this.toggleModal('updateProductModal');
            },
          });
          break;
        case 'delete':
          this.formKriteria.delete(
            route('kriteria.destroy', this.kriteria.id),
            {
              onSuccess: () => {
                this.loadList();
                this.toggleModal('deleteModal');
              },
            }
          );
          break;
        case 'deleteAll':
          this.formKriteria.delete(route('kriteria.destroyAll'), {
            onSuccess: () => {
              this.loadList();
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
      const item = this.kriteriaList.splice(index, 1)[0];
      this.kriteriaList.splice(index - 1, 0, item);
    },

    moveDown(index) {
      const item = this.kriteriaList.splice(index, 1)[0];
      this.kriteriaList.splice(index + 1, 0, item);
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
      this.formKriteria.nama = this.kriteria.nama;
      this.formKriteria.rank.value = this.kriteria.rank;
      this.formKriteria.rank.oldValue = this.kriteria.rank;
    },

    setSubkriteria(itemList) {
      this.subKriteriaList = itemList;
    },
    resetForm() {
      this.formKriteria.reset();
      this.formKriteria.errors = '';
    },
    toggleModal(modalName) {
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

    handleSearch() {
      if (this.searchTimeout) clearTimeout(this.searchTimeout);
      this.searchTimeout = setTimeout(() => {
        this.loadList();
      }, 1000);
    },
  },

  getters: {
    getBobot() {
      const list = [];
      const n = this.kriteriaList.length;
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
      let filteredList = [...state.kriteriaList];
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
      if (state.searchQuery.trim()) {
        const searchFiltered = state.searchQuery.trim().toLowerCase();
        filteredList = filteredList.filter((value) => {
          return value.nama.trim().toLowerCase().includes(searchFiltered);
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
