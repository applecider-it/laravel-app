<script lang="ts" setup>
import { ref, onMounted } from "vue";
import type ChatClient from "../ChatClient";
import { User, Message } from "@/services/chat/types";

interface Prop {
    chatClient: ChatClient;
}

const props = defineProps<Prop>();

const message = ref("");
const messageList = ref<Message[]>([]);
const userList = ref<User[]>([]);

onMounted(() => {
    props.chatClient.addMessage = (row: Message) => {
        messageList.value = [row, ...messageList.value];
    };

    props.chatClient.setUsers = (users: User[]) => {
        console.log("users", users);
        userList.value = [...users];
    };
});

const sendMessage = (options: any = {}) => {
    console.log(message.value);
    props.chatClient.sendMessage(message.value, options);
    message.value = "";
};

const handleKeyDown = (e: KeyboardEvent) => {
    if (e.key === "Enter") sendMessage();
};
</script>

<template>
    <div>
        <div>
            <input
                type="text"
                v-model="message"
                class="border p-1 mr-2 w-80"
                @keydown="handleKeyDown"
            />
            <button class="p-1 border bg-gray-200 ml-2" @click="sendMessage()">
                Send (E)
            </button>

            <button
                class="p-1 border bg-gray-200 ml-2"
                @click="sendMessage({ others: true })"
            >
                Send (E,O)
            </button>
        </div>

        <div class="border border-gray-700 p-2 mb-2 h-80 mt-5 overflow-y-auto">
            <p v-for="(data, index) in messageList" :key="index">
                {{ data.data.message }}
                <span class="ml-2 text-sm text-gray-400">
                    by {{ data.data.name }}
                </span>
            </p>
        </div>

        <div class="mt-5">
            接続ユーザー一覧
            <div
                class="border-2 border-gray-300 p-2 mb-2 h-40 mt-2 overflow-y-auto"
            >
                <p v-for="(user, index) in userList" :key="index">
                    {{ user.id }} {{ user.name }}
                </p>
            </div>
        </div>
    </div>
</template>
