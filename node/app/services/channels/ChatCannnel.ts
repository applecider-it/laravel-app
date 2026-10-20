import { log } from '@/services/system/log.js';

import { WebSocketUser, Incoming } from '@/services/web-socket/types.js';

import BaseCannnel from './BaseCannnel.js';

/**
 * チャットチャンネル
 *
 * target_user_idが指定されているときは、対象のuser_idにだけ送信。
 */
export default class ChatCannnel extends BaseCannnel {
  constructor() {
    super();
  }

  enableWebSocketSend(){
    return true;
  }

  enableSendUsers(){
    return true;
  }

  async callbackCreateData(sender: WebSocketUser, incoming: Incoming) {
    return {
      message: incoming.data.message,
      name: incoming.data.name,
    };
  }

  async callbackCheckSend(
    sender: WebSocketUser,
    user: WebSocketUser,
    incoming: Incoming
  ) {
    const targetUserId = incoming.data.target_user_id ?? null;

    log('targetUserId', [targetUserId], user);

    // target_user_idが指定されているときは、対象のuser_idにだけ送信。
    if (targetUserId && targetUserId !== user.id) return false;

    return true;
  }
}
