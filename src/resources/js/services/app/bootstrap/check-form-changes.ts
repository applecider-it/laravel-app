import { checkFormChanges } from "@/services/form/nav";

const elements = document.querySelectorAll(
  "[data-app-element-check-form-changes]",
);

type Props = {
  type: string;
};

elements.forEach((el: HTMLFormElement) => {
  const all = JSON.parse(el.dataset.appElementCheckFormChanges) as Props;
  console.log('appElementCheckFormChanges', all)

  checkFormChanges(el, all.type);
});
