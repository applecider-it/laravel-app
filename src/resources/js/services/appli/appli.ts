interface NavigatorWithStandalone extends Navigator {
    standalone?: boolean;
}

/** PWA（スタンドアロンモード）として起動しているかどうかを判定する */
export function isPWA() {
    // 標準ブラウザ（Chrome, Edge, Androidなど）の判定
    const isStandalone = window.matchMedia(
        "(display-mode: standalone)",
    ).matches;

    // iOS Safari環境の判定
    const nav = window.navigator as NavigatorWithStandalone;
    const isIOSStandalone = nav.standalone === true;

    return isStandalone || isIOSStandalone;
}
