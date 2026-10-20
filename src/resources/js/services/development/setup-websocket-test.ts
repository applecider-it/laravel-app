/**
 * WebSocketテストのセットアップ
 */

import { createApp } from "vue";
import TestWebSocketAreaVue from "./vue/TestWebSocketAreaVue.vue";

let el: any;

el = document.getElementById("vue-test-root");

if (el) {
    const all = JSON.parse(el.dataset.all);

    console.log("vue all", all);

    const app = createApp(TestWebSocketAreaVue, {});
    app.mount("#vue-test-root");
}
