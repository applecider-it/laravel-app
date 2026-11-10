/**
 * チャットのセットアップ
 */

import { createApp } from "vue";
import ChatArea from "./vue/ChatArea.vue";

import ChatClient from "./ChatClient";

type Props = {
  wsHost: string;
  token: string;
  room: string;
};

const el: any = document.getElementById("chat-root");

if (el) {
  const all = JSON.parse(el.dataset.all) as Props;

  console.log("all", all);

  const chatClient = new ChatClient(all.token, all.wsHost, all.room);

  createApp(ChatArea, { chatClient }).mount(el);
}
