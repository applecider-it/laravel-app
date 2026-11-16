/**
 * Bladeから使える、共通のオブジェクト
 */

import { writeClipboard } from "@/services/ui/edit";
import { checkFormChanges } from "@/services/form/nav";

export const App = {
  funcs: {
    writeClipboard,
    checkFormChanges,
  },
};
