import { checkDirty } from "@/services/form/nav";

const elements = document.querySelectorAll(
  "[data-app-element-require-dirtycheck]",
);

type Props = {
  type: string;
};

elements.forEach((el: HTMLFormElement) => {
  const all = JSON.parse(el.dataset.appElementRequireDirtycheck) as Props;
  console.log('appElementRequireDirtycheck', all)

  checkDirty(el, all.type);
});
