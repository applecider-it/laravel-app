import { checkDirty } from "@/services/form/nav";

const elements = document.querySelectorAll(
  "[data-app-element-require-dirtycheck]",
);

elements.forEach((el: HTMLFormElement) => {
  const val = el.dataset.appElementRequireDirtycheck as "on" | "clear";
  console.log('appElementRequireDirtycheck', {val})
  checkDirty(el, val);
});
