import { ref } from "vue";

export function delay(ms = 1000) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

export function useFlash(isShown = false) {
    const shown = ref(isShown);

    const flash = async () => {
        shown.value = true;
        await delay(3000); // wait 3 seconds
        shown.value = false;
    };

    return { shown, flash };
}
