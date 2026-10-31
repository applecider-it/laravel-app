<script setup lang="ts">
/** UI動作確認 */

import { useAppli } from "@/services/appli/vue-hook/useAppli";

const { pwa } = useAppli();
</script>

<template>
    <div>
        アプリ動作確認

        <div class="my-10 p-10 border-4">
            <div v-if="pwa">アプリで起動</div>
            <div v-else>ブラウザで起動</div>
        </div>
    </div>
</template>
