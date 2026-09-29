export type User = { id: number; name: string };

export type Message = { data: { message: string; name: string } };

export type MessageType = "websocket" | "redis";
