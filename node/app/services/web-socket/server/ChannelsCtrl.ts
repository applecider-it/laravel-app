import BaseCannnel from '@/services/channels/BaseCannnel.js';

type Channels = {
  base: BaseCannnel;
};

/**
 * WebSocket サーバーのチャンネル管理
 */
export default class ChannelsCtrl {
  /** 全てのチャンネルクラスを集めたハッシュ */
  private channels: Channels;

  constructor() {
    this.channels = {
      base: new BaseCannnel(),
    };
  }

  /** チャンネルごとのインスタンス */
  getChannel(channelStr: string) {
    const [channel, paramsStr] = channelStr.split(':');

    if (channel in this.channels) {
      return this.channels[channel as keyof Channels];
    }

    return this.channels.base;
  }
}
