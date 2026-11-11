<?php

namespace App\Services\Tweet;

use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\User\Tweet as UserTweet;

/**
 * ツイートの編集関連
 */
class EditService
{
    public function __construct(
        private WebsocketService $tweetWebsocketService,
        private JsonService $jsonService,
    ) {}

    /**
     * 指定したユーザーの新しいツイート作成
     */
    public function newTweet(User $user, UserTweet $tweet)
    {
        $tweet = $user->tweets()->save($tweet);

        $tweetArray = $this->jsonService->tweetToJsonArray($tweet);

        $this->tweetWebsocketService->sendNewTweet($tweetArray);

        Log::info('tweetArray', [$tweetArray]);
    }
}
