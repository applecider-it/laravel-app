/** 変更フラグ */
let isDirty = false;
/** 初期化フラグ */
let isInit = false;

/** 離脱チェックの初期化 */
function init() {
  if (!isInit) {
    window.addEventListener("beforeunload", function (e) {
      if (isDirty) {
        e.preventDefault();
        e.returnValue = "";
      }
    });

    console.log("checkFormChanges init");

    isInit = true;
  }
}

/**
 * フォーム変更チェック
 *
 * options:
 * clearOnly: trueの場合は、フォーム変更チェックのクリアのみ
 */
export function checkFormChanges(form: HTMLFormElement, options: any = {}) {
  // マルチパート指定の時はContent-Typeを変更
  const clearOnly = "clearOnly" in options && options.clearOnly;

  console.log("checkFormChanges setup", { options, clearOnly });

  init();

  if (!clearOnly) {
    // 変更監視を有効にする場合

    // 変更時に変更監視フラグを有効化
    form.addEventListener("change", () => {
      console.log("checkFormChanges on");
      isDirty = true;
    });
  }

  // 送信時に変更監視フラグを無効化
  form.addEventListener("submit", () => {
    console.log("checkFormChanges off");
    isDirty = false;
  });
}
