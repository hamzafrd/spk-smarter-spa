import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import { Modal } from "flowbite";
import { defineStore } from "pinia";

export const useFormStore = defineStore("forms", {
    state: () => ({
        formKriteria: useForm({
            nama: "",
            rank: "",
        }),
        kriteriaList: {
            type: Array,
            default: null,
        },

        kriteria: {
            nama: "",
            rank: "",
            bobot: "",
        },

        massEdit: true,
        showBobot: false,

        modalName: "",
        createKriteria: {
            type: Modal,
            default: null,
        },
    }),

    actions: {
        async loadList() {
            try {
                const response = await axios.get(route("api.listkriteria"));
                this.kriteriaList = response.data.updatedData;
            } catch (error) {
                console.log(error.response);
            }
        },

        async updatePositions() {
            try {
                const response = await axios.put("/updkriteria", {
                    listKriteria: this.kriteriaList,
                    bobot: this.getBobot,
                });
                this.kriteriaList = response.data.updatedData;
            } catch (error) {
                console.error("Error saving positions:", error);
            }
        },

        toggleModal(modalName, isShow) {
            this.modalName != modalName ? (this.modalName = modalName) : null;
            this.createKriteria = this.getModal;
            isShow ? this.createKriteria.show() : this.createKriteria.hide();
        },

        submitForm(params) {
            switch (params) {
                case "store":
                    this.formKriteria.post(route("kriteria.store"), {
                        onSuccess: () => {
                            this.formKriteria.nama = "";
                            this.formKriteria.rank = "";
                            this.loadList();
                            this.toggleModal("createProductModal");
                        },
                    });
                    break;
                case "update":
                    this.formKriteria.put(
                        route("kriteria.update", this.kriteria.id),
                        {
                            onSuccess: () => {
                                this.formKriteria.nama = "";
                                this.formKriteria.rank = "";
                                this.loadList();
                                this.toggleModal("updateProductModal");
                            },
                        },
                    );
                    break;
                case "delete":
                    this.formKriteria.delete(
                        route("kriteria.destroy", this.kriteria.id),
                        {
                            onSuccess: () => {
                                this.loadList();
                                this.toggleModal("deleteModal");
                            },
                        },
                    );
                    break;
                case "deleteAll":
                    this.formKriteria.delete(route("kriteria.destroyAll"), {
                        onSuccess: () => {
                            this.loadList();
                            this.toggleModal("deleteAllModal");
                        },
                    });
                    break;

                default:
                    console.log("not yet implemented");
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
            const currentEl = document.getElementById("kriteria" + index);
            const prevEl = document.getElementById("kriteria" + (index - 1));
            const nextEl = document.getElementById("kriteria" + (index + 1));
            const rankEl = currentEl.querySelector(".rankKriteria");
            const delay = 200;

            const toggleClass = (el) =>
                el.classList.toggle("child:bg-primary-700/50");

            toggleClass(currentEl);

            setTimeout(() => {
                toggleClass(currentEl);

                if (direction === "up") {
                    const prevRankEl = prevEl.querySelector(".rankKriteria");
                    toggleClass(prevEl);

                    setTimeout(() => {
                        toggleClass(prevEl);
                        this.moveRank(index, [prevRankEl, rankEl], true);
                    }, delay);

                    this.moveUp(index);
                } else {
                    const nextRankEl = nextEl.querySelector(".rankKriteria");
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
            this.formKriteria.rank = this.kriteria.rank;
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
    },
});

export const useSideNavStatus = defineStore("sidenav", {
    state: () => ({
        status: true,
    }),

    actions: {
        toggle() {
            this.status = !this.status;
        },
    },

    getters: {
        isExtended: (state) => (!state.status ? "opacity-0" : "opacity-1"),
    },
});

export const useThemeStore = defineStore("theme", {
    state: () => ({
        isThemeDark:
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches),
    }),

    actions: {
        toggleTheme() {
            this.isThemeDark = !this.isThemeDark;

            if (this.isThemeDark) {
                localStorage.theme = "dark";
                $("body").addClass("dark");
            } else {
                localStorage.theme = "light";
                $("body").removeClass("dark");
            }
        },
    },

    getters: {
        getTheme: (state) => state.isThemeDark,
    },
});
