<script setup lang="ts">
/** 遅いジョブ動作確認 */

import axios from "axios";

import { ref } from "vue";

import { showToast } from "@/services/ui/message";

import ProgressBar from "@/services/ui/vue/message/ProgressBar.vue";

import { sleep } from "@/services/system/datetime";

const progress = ref<number>(0);

/** 経過観察 */
const checkProgress = async () => {
    const response = await axios.post(
        "/development/start_slow_polling_job_progress",
        {},
    );
    console.log("response.data", response.data);

    const data = response.data.data;

    if (data) {
        showToast(Math.floor(data.cursor * 100) + "%完了");
        progress.value = data.cursor * 100;

        if (data.cursor != 1) {
            await sleep(2000);

            checkProgress();
        }
    }
};

/** 遅いジョブの開始 */
const SlowJobTest = async () => {
    console.log("SlowJobTest");
    progress.value = 0;

    const response = await axios.post("/development/start_slow_polling_job", {
        test: 123,
        test2: { test3: 456 },
    });
    console.log("response.data", response.data);

    showToast("送信しました。");

    await sleep(2000);

    checkProgress();
};
</script>

<template>
    <div>
        遅いジョブ動作確認 (Polling)

        <div class="mt-5 space-y-2">
            <button className="app-btn-orange" @click="SlowJobTest">
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
