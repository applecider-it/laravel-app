<script setup lang="ts">
/** vueテスト用コンポーネント */

import { ref } from "vue";

import DefineModelArea from "./test-area-vue/DefineModelArea.vue";
import EmitModelArea from "./test-area-vue/EmitModelArea.vue";
import UIArea from "./test-area-vue/UIArea.vue";
import FormArea from "./test-area-vue/FormArea.vue";
import UploadArea from "./test-area-vue/UploadArea.vue";
import SlowJobArea from "./test-area-vue/SlowJobArea.vue";
import AppliArea from "./test-area-vue/AppliArea.vue";

interface Props {
    testValue?: number;
    formData: any;
}

const props = defineProps<Props>();

const blockStyle = "border-gray-400 border-2 p-3";

const appliOpen = ref(true);
</script>

<template>
    <div class="py-6 border-gray-500 border-2 p-5">
        <div class="mb-6 text-lg">vue.js動作確認</div>

        <div class="space-y-4">
            <div :class="blockStyle">
                <UIArea />
            </div>

            <div :class="blockStyle">
                <DefineModelArea />
            </div>

            <div :class="blockStyle">
                <EmitModelArea />
            </div>

            <div :class="blockStyle">
                <FormArea
                    :listVal="formData.list_val"
                    :radioVal="formData.radio_val"
                    :dateTimeVal="formData.datetime_val"
                    :listVals="formData.list_vals"
                    :radioVals="formData.radio_vals"
                />
            </div>

            <div :class="blockStyle">
                <UploadArea />
            </div>

            <div :class="blockStyle">
                <SlowJobArea />
            </div>

            <div :class="blockStyle">
                <div v-if="appliOpen">
                    <AppliArea />
                </div>
                <button class="app-btn-primary" @click="appliOpen = !appliOpen">
                    開閉
                </button>
            </div>
        </div>
    </div>
</template>
