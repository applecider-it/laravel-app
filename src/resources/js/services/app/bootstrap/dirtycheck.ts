import { checkDirty } from "@/services/form/nav";

const el = document.getElementById("app-form-require-dirtycheck");

if (el) {
    checkDirty(el);
}
