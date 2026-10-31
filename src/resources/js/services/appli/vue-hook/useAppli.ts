import { ref, onMounted, onUnmounted } from "vue";

import { isPWA } from "../appli";

/**
 * アプリ管理用フック
 */
export function useAppli() {
    /** ロケーションバー等の「アプリで開く」で開いた時のコールバック */
    function callbackRefresh(e: MediaQueryListEvent) {
        if (e.matches) {
            {
                console.log("useAppli::callbackRefresh");

                pwa.value = isPWA();
            }
        }
    }

    const pwa = ref(isPWA());
    const mediaQuery = window.matchMedia("(display-mode: standalone)");

    onMounted(() => {
        console.log("useAppli::onMounted");

        mediaQuery.addEventListener("change", callbackRefresh);
    });

    onUnmounted(() => {
        console.log("useAppli::onUnmounted");

        mediaQuery.removeEventListener("change", callbackRefresh);
    });

    return { pwa };
}
