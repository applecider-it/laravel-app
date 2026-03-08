import { showToast } from "./message";

/** クリップボードにコピーする */
export function writeClipboard(el) {
    const text = el.dataset.clipboardData;
    navigator.clipboard.writeText(text);
    el.innerText = "Copied";

    showToast("コピーしました。");
}
