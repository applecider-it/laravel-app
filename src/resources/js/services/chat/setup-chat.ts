/**
 * チャットのセットアップ
 */

import { createApp } from "vue";
import ChatArea from "./vue/ChatArea.vue";

import ChatClient from "./ChatClient";

const el: any = document.getElementById("chat-root");

if (el) {
    const all = JSON.parse(el.dataset.all);

    console.log("all", all);

    const chatClient = new ChatClient(all.token, all.wsHost, all.room);

    createApp(ChatArea, { chatClient }).mount(el);
}
