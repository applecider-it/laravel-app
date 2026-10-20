<script setup lang="ts">
/** vueテスト用コンポーネント */

import LaravelEchoArea from "./test-websocket-area-vue/LaravelEchoArea.vue";

const blockStyle = "border-gray-400 border-2 p-3";
</script>

<template>
    <div class="py-6 border-gray-500 border-2 p-5">
        <div class="mb-6 text-lg">WebSocket動作確認</div>

        <div class="space-y-4">
            <div :class="blockStyle">
                <LaravelEchoArea />
            </div>
        </div>
    </div>
</template>
