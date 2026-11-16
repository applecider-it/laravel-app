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

    console.log("checkDirty init");

    isInit = true;
  }
}

/**
 * フォーム変更チェック
 * 
 * type:  
 * on: 有効  
 * clear: フォーム変更チェックのクリアのみ  
 */
export function checkFormChanges(form: HTMLFormElement, type: string = "on") {
  console.log("checkDirty setup", {type});

  // typeのエラーチェック
  if (!["on", "clear"].includes(type))
    throw new Error(`checkDirty type error ${type}`);

  init();

  if (type === "on") {
    // 変更監視を有効にする場合

    // 変更時に変更監視フラグを有効化
    form.addEventListener("change", () => {
      console.log("checkDirty on");
      isDirty = true;
    });
  }

  // 送信時に変更監視フラグを無効化
  form.addEventListener("submit", () => {
    console.log("checkDirty off");
    isDirty = false;
  });
}
