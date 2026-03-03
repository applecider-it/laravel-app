<script setup lang="ts">
import { ref, computed, onMounted } from "vue";
import { components } from "../router-test/router";

interface Props {
    name: string;
}

const props = defineProps<Props>();

const current = ref("Parts1");
const currentComponent = computed(() => components[current.value]);

const commonCnt = ref<number>(0);

// 初期化時
onMounted(() => {
    console.log("router test mounted");
});
</script>

<template>
    <div class="text-lg">router動作確認</div>

    <div class="mt-5 space-y-2">
        <div>タグからの値: {{ name }}</div>
        <div>
            <span>commonCnt: {{ commonCnt }}</span>
        </div>
    </div>

    <div class="mt-5 space-x-2">
        <button
            @click="current = 'Parts1'"
            :class="[
                current === 'Parts1' ? 'app-link-active' : 'app-link-normal',
            ]"
        >
            Parts1
        </button>
        <button
            @click="current = 'Parts2'"
            :class="[
                current === 'Parts2' ? 'app-link-active' : 'app-link-normal',
            ]"
        >
            Parts2
        </button>
    </div>

    <div class="mt-3">
        <keep-alive>
            <component :is="currentComponent" v-model:commonCnt="commonCnt" />
        </keep-alive>
    </div>
</template>
