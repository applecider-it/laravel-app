/**
 * Bladeから使える、共通のオブジェクト
 */

import { writeClipboard } from "@/services/html/edit";
import { checkFormChanges } from "@/services/form/check-form-changes";

export const App = {
  funcs: {
    writeClipboard,
    checkFormChanges,
  },
};
