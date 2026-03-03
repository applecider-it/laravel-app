<script setup lang="ts">
import { ref, onMounted } from "vue";
import { showToast } from "@/services/ui/message";

const commonCnt = defineModel<number>("commonCnt");

const cnt = ref<number>(0);

const execToast = () => {
    showToast("トーストテスト");
};

// 初期化時
onMounted(() => {
    console.log("parts2 mounted");
});
</script>

<template>
    <div class="p-5 border-gray-500 border-2">
        <h3 class="text-xl font-bold">Page2 Parts2</h3>

        <div class="space-y-2 mt-5">
            <div>
                <button @click="commonCnt++" class="app-btn-primary">
                    Add Common
                </button>
            </div>
            <div>
                <span>cnt: {{ cnt }}</span>
            </div>
            <div>
                <button @click="cnt++" class="app-btn-primary">Add</button>
            </div>
            <div>
                <button @click="execToast" class="app-btn-primary">
                    Toast
                </button>
            </div>
        </div>
    </div>
</template>
