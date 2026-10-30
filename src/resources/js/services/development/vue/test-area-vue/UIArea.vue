<script setup lang="ts">
/** UI動作確認 */

import { ref } from "vue";

import { showToast, setIsLoading } from "@/services/ui/message";
import LoadingInline from '@/services/ui/vue/message/LoadingInline.vue';

const inline = ref<boolean>(false);

/** ロード画面の動作確認 */
const loadingTest = () => {
    console.log("Loading");
    setIsLoading(true);
    setTimeout(() => {
        setIsLoading(false);
    }, 2000);
};

const loadingInlineTest = () => {
    console.log("LoadingInline");
    inline.value = true;
    setTimeout(() => {
        inline.value = false;
    }, 4000);
};

/** トーストの動作確認 */
const toastTest = (type) => {
    const msg = `トーストテスト type:${type}`;
    console.log(msg);
    showToast(msg, type);
};
</script>

<template>
    <div>
        UI動作確認

        <div class="mt-5">
            <button class="app-btn-secondary mr-2" @click="loadingTest">
                Loading
            </button>
            <button class="app-btn-secondary mr-2" @click="loadingInlineTest">
                Loading inline
            </button>
            <div v-if="inline">
                <LoadingInline />
            </div>
        </div>

        <div class="mt-5 space-x-2">
            <button class="app-btn-primary" @click="() => toastTest('notice')">
                Toast notice
            </button>
            <button class="app-btn-primary" @click="() => toastTest('alert')">
                Toast alert
            </button>
            <button
                class="app-btn-primary"
                @click="
                    () => {
                        toastTest('notice');
                        toastTest('alert');
                    }
                "
            >
                Toast 2
            </button>
        </div>
    </div>
</template>
