import { MyEcho } from "@/services/app/echo";
import { showToast } from "@/services/ui/message";

import { sendMessage } from "@/services/api/rpc/chat-echo-rpc";

import { User, Message } from "@/services/chat/types";

/**
 * チャット(Echo)クライアント
 */
export default class ChatClient {
    private room;
    private users: User[] = [];

    addMessage: (row: Message) => void;
    setUsers: (users: User[]) => void;

    constructor(room) {
        this.room = room;

        this.initEcho();
    }

    /** Laravel Echo 接続初期化 */
    private initEcho() {
        MyEcho.join(`Chat.${this.room}`)
            .here((users) => this.setupUsers(users))
            .joining((user) => this.addUser(user))
            .leaving((user) => this.removeUser(user))
            .listen("ChatMessageSent", (e) => this.handleMessage(e));
    }

    /** メッセージ送信 */
    sendMessage(message: string, options: any) {
        console.log("sendMessage", options);

        if (!message) {
            console.warn("[DEBUG] WebSocket not ready or empty message");
            return;
        }

        sendMessage(message, this.room, options);
    }

    /** ユーザー一覧セットアップ */
    private setupUsers(users: User[]) {
        this.users = users;
        this.refreshUsers();
    }

    /** ユーザー追加（重複防止付き） */
    private addUser(user: User) {
        const exists = this.users.some((u) => u.id === user.id);

        if (!exists) {
            console.log("push user", user);
            this.users.push(user);

            showToast(`${user.name}さんが、入室しました。`);

            this.refreshUsers();
        }
    }

    /** ユーザー削除 */
    private removeUser(user: User) {
        this.users = this.users.filter((u) => u.id !== user.id);

        showToast(`${user.name}さんが、退室しました。`);

        this.refreshUsers();
    }

    /** ユーザー一覧を反映 */
    private refreshUsers() {
        this.setUsers(this.users);
    }

    /** メッセージ受信 */
    private handleMessage(e) {
        console.log("handleMessage", e);

        this.addMessage({
            data: {
                message: e.message,
                name: e.user.name,
            },
        });
    }
}
