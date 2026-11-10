/**
 * チャットのセットアップ
 */

import { createApp } from "vue";
import ChatArea from "./vue/ChatArea.vue";

import ChatClient from "./ChatClient";

type Props = {
  room: string;
};

const el = document.getElementById("chat-root") as HTMLElement | null;

if (el) {
  const all = JSON.parse(el.dataset.all as string) as Props;

  console.log("all", all);

  const chatClient = new ChatClient(all.room);

  const app = createApp(ChatArea, {
    chatClient: chatClient,
  });

  app.mount(el);
}
