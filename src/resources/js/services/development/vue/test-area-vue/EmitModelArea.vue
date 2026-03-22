<script setup lang="ts">
/** vueテスト用コンポーネント */

import { ref } from "vue";

import MyForm from "./emit-model-area/MyForm.vue";

const title = ref<string>("");
const content = ref<string>("");
</script>

<template>
    <div>
        EmitでModelのような動作の確認

        <div class="mt-5">
            <p>title: {{ title }}</p>
            <p>content: {{ content }}</p>

            <MyForm
                :title="title"
                @update:title="title = $event"
                :content="content"
                @update:content="content = $event"
            />
        </div>
    </div>
</template>
