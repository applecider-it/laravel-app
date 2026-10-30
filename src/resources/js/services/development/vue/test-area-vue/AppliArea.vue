<script setup lang="ts">
/** UI動作確認 */

import { onMounted } from "vue";

import { isPWA, setupRefreshPWA } from "@/services/appli/appli.js";

const pwa = isPWA();

onMounted(() => {
    setupRefreshPWA();
});
</script>

<template>
    <div>
        アプリ動作確認

        <div class="mt-5">
            <div v-if="pwa">アプリで起動</div>
            <div v-else>ブラウザで起動</div>
        </div>
    </div>
</template>
