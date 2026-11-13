import { showToast } from "./message";

/** クリップボードにコピー */
export function writeClipboard(val: string, resultEl: HTMLElement) {
  const resultText = "Copied";
  const toastText = "コピーしました。";

  // クリップボードにコピー
  navigator.clipboard.writeText(val);

  // 元の文字列を保存
  if (resultEl.dataset.writeClipboardOriginal === undefined)
    resultEl.dataset.writeClipboardOriginal = resultEl.innerText;

  resultEl.innerText = resultText;

  showToast(toastText);

  // 一定時間経過したら元の文字列に戻す
  setTimeout(() => {
    resultEl.innerText = resultEl.dataset.writeClipboardOriginal;
  }, 3000);
}
