import { checkDirty } from "@/services/form/nav";

const elements = document.querySelectorAll(
  "[data-app-form-require-dirtycheck]",
);

elements.forEach((el: HTMLFormElement) => {
  const val = el.dataset.appFormRequireDirtycheck as "on" | "clear";
  console.log('appFormRequireDirtycheck', {val})
  checkDirty(el, val);
});
