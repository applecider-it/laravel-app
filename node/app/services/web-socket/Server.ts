import { WebSocket, WebSocketServer } from 'ws';

import { log } from '@/services/system/log.js';
import { appConfig } from '@/config/config.js';

import RedisCtrl from './server/RedisCtrl.js';
import WebSocketCtrl from './server/WebSocketCtrl.js';
import UsersCtrl from './server/UsersCtrl.js';
import AuthCtrl from './server/AuthCtrl.js';
import BroadcastCtrl from './server/BroadcastCtrl.js';

import { WebSocketUser, Incoming, BroadcastSendData } from './types.js';

/**
 * WebSocket サーバー管理
 */
export default class Server {
  /** WebSocket サーバーのRedis管理 */
  private redisCtrl;
  /** WebSocket サーバーのWebSocket管理 */
  private webSocketCtrl;
  /** WebSocket サーバーの全てのユーザー管理 */
  private usersCtrl;
  /** WebSocket サーバーのBroadcast管理 */
  private broadcastCtrl;
  /** WebSocket サーバーのAuth管理 */
  private authCtrl;

  constructor() {
    const host = appConfig.webSocket.host;
    const port = appConfig.webSocket.port;
    const redisUrl = appConfig.redis.url;

    this.broadcastCtrl = new BroadcastCtrl();
    this.authCtrl = new AuthCtrl();

    this.usersCtrl = new UsersCtrl(this.broadcastCtrl);

    // WebSocket管理初期化
    this.webSocketCtrl = new WebSocketCtrl(
      host,
      port,
      async (wss: WebSocketServer, ws: WebSocket) => {
        await this.onConnect(wss, ws);
      },
      async (wss: WebSocketServer, ws: WebSocket) => {
        await this.onDisconnect(wss, ws);
      },
      this.authCtrl,
    );

    // Redis管理初期化
    this.redisCtrl = new RedisCtrl(
      async (sender: WebSocketUser, incoming: Incoming, type: string) => {
        await this.onRedisMessage(sender, incoming, type);
      },
      redisUrl,
    );
  }

  /** Redisメッセージ受信時の処理 */
  async onRedisMessage(
    sender: WebSocketUser,
    incoming: Incoming,
    type: string,
  ) {
    this.usersCtrl.updateGlobalUser(sender, incoming, type);

    await this.broadcast(sender, incoming, type);
  }

  /** 接続時の処理 */
  async onConnect(wss: WebSocketServer, ws: WebSocket) {
    const user = ws.user as WebSocketUser;

    const channel = user.channel;

    // 接続したユーザーのみ送信
    ws.send(
      JSON.stringify({
        type: 'connected',
        users: this.usersCtrl.getSameChannelUsers(wss, ws),
      }),
    );

    // 同じチャンネルへの全体送信

    const type = 'connectOther';
    const data = {
      user: this.broadcastCtrl.toBroadcastUser(user),
    };

    await this.sendBySystem(channel, data, type);
  }

  /** 切断時の処理 */
  async onDisconnect(wss: WebSocketServer, ws: WebSocket) {
    // 同じチャンネルへの全体送信

    const user = ws.user as WebSocketUser;

    const channel = user.channel;

    const type = 'disconnectOther';
    const data = {
      user: this.broadcastCtrl.toBroadcastUser(user),
    };

    await this.sendBySystem(channel, data, type);
  }

  /** システムからの全体送信 */
  async sendBySystem(channel: string, data: any, type: string) {
    await this.redisCtrl.publish(channel, data, type);
  }

  /** 送信処理 */
  async broadcast(sender: WebSocketUser, incoming: Incoming, type: string) {
    log('incoming', incoming);
    log('sender', sender);

    const sendData: BroadcastSendData = {
      type: type,
      data: incoming.data,
    };

    this.broadcastCtrl.broadcastSameChannel(
      sendData,
      sender,
      this.webSocketCtrl.wss,
    );
  }
}
