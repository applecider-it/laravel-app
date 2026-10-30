interface NavigatorWithStandalone extends Navigator {
    standalone?: boolean;
}

/** PWA（スタンドアロンモード）として起動しているかどうかを判定する */
export function isPWA(): boolean {
    // 標準ブラウザ（Chrome, Edge, Androidなど）の判定
    const isStandalone = window.matchMedia(
        "(display-mode: standalone)",
    ).matches;

    // iOS Safari環境の判定
    const nav = window.navigator as NavigatorWithStandalone;
    const isIOSStandalone = nav.standalone === true;

    return isStandalone || isIOSStandalone;
}

/** ロケーションバー等の「アプリで開く」で開いた時に状態が残るのを防ぐ */
export function setupRefreshPWA() {
    const mediaQuery = window.matchMedia("(display-mode: standalone)");

    mediaQuery.addEventListener("change", (e) => {
        if (e.matches) {
            // 状態が残るのを防ぐため、強制的にリロードしてクリーンな状態で起動する
            window.location.reload();
        }
    });
}
