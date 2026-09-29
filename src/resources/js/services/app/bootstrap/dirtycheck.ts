import { checkDirty } from "@/services/form/nav";

const elements = document.querySelectorAll('[data-app-form-require-dirtycheck]');

elements.forEach(el => {
    checkDirty(el);
});
