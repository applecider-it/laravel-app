/**
 * ツイートのセットアップ
 */

import { createApp } from "vue";
import TweetArea from "./vue/TweetArea.vue";
import TweetClient from "./TweetClient";

import { Tweet } from "./types.js";

type Props = {
  wsHost: string;
  token: string;
  tweets: Tweet[];
};

const el = document.getElementById("tweet-app") as HTMLElement | null;

if (el) {
  const all = JSON.parse(el.dataset.all as string) as Props;

  console.log(all);

  const tweetClient = new TweetClient(all.token, all.wsHost);

  createApp(TweetArea, {
    initialTweets: all.tweets,
    tweetClient: tweetClient,
  }).mount(el);
}
