import { showToast } from "./message";

/** クリップボードにコピーする */
export function writeClipboard(val: string, resultEl: HTMLElement) {
    const resultText = "Copied";
    const toastText = "コピーしました。";

    navigator.clipboard.writeText(val);

    resultEl.innerText = resultText;

    showToast(toastText);
}
