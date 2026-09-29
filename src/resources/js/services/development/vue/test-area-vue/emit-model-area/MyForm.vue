<script setup lang="ts">
const emit = defineEmits<{
    (e: "update:title", value: string): void;
    (e: "update:content", value: string): void;
}>();

const props = defineProps({
    title: String,
    content: String,
});

const addText = () => {
    emit("update:content", props.content + "[add text]");
};
</script>

<template>
    <div class="border-2 border-gray-300 p-2">
        <div>MyForm: title</div>
        <input
            :value="title"
            @input="
                $emit('update:title', ($event.target as HTMLInputElement).value)
            "
            class="app-form-input"
        />
        <div class="mt-2">MyForm: content</div>
        <textarea
            :value="content"
            @input="
                $emit(
                    'update:content',
                    ($event.target as HTMLInputElement).value,
                )
            "
            class="app-form-input"
        ></textarea>

        <div class="mt-5 space-x-2">
            <button class="app-btn-primary" @click="addText">addText</button>
        </div>
    </div>
</template>
