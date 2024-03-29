import { defineStore } from "pinia";

export const useCounterStore = defineStore("counter", {
    state: () => ({
        count: 0,
    }),

    actions: {
        increaseCount() {
            this.count++;
        },
    },

    getters: {
        doubleCount: (state) => state.count * 2,
        doublePlusOne() {
            return this.doubleCount + 1;
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
