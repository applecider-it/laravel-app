<script setup lang="ts">
/** 遅いジョブ動作確認 */

import axios from "axios";

import { ref, onMounted } from "vue";

import { showToast } from "@/services/ui/message";

import ProgressBar from "@/services/ui/vue/message/ProgressBar.vue";

import { sleep } from "@/services/system/datetime";

const progress = ref<number>(0);

const enable = ref(false);

/** 開始API送信 */
const sendStart = async () => {
    const response = await axios.post("/development/start_slow_job", {
        test: 123,
        test2: { test3: 456 },
    });
    console.log("response.data", response.data);
};

/** 経過観察API送信 */
const sendProgress = async () => {
    const response = await axios.post(
        "/development/start_slow_job_progress",
        {},
    );
    console.log("response.data", response.data);

    const data = response.data.data;

    return data;
};

/** 経過観察 */
const checkProgress = async () => {
    const data = await sendProgress();

    // 構造上ないけど一応チェック
    if (!data) return;

    showToast(Math.floor(data.cursor * 100) + "%完了");
    progress.value = data.cursor * 100;

    if (data.cursor != 1) {
        await sleep(2000);

        checkProgress();
    } else {
        enable.value = true;
    }
};

/** 遅いジョブの開始 */
const startSlowJob = async () => {
    if (!enable.value) return;

    enable.value = false;

    console.log("SlowJobTest");
    progress.value = 0;

    await sendStart();

    showToast("送信しました。");

    await sleep(2000);

    checkProgress();
};

/** ジョブが動いているかの確認 */
const checkStarted = async () => {
    const data = await sendProgress();

    if (data && data.cursor != 1) {
        checkProgress();
    } else {
        enable.value = true;
    }
};

onMounted(async () => {
    await checkStarted();
});
</script>

<template>
    <div>
        遅いジョブ動作確認

        <div class="mt-5 space-y-2">
            <button
                :class="enable ? `app-btn-orange` : `app-btn-secondary`"
                @click="startSlowJob"
            >
                遅いジョブ
            </button>

            <ProgressBar :progress="progress" />

            <button
                @click="() => (progress = progress + 10)"
                className="app-btn-secondary"
            >
                進める
            </button>
        </div>
    </div>
</template>
