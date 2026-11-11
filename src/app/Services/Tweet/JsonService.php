<?php

namespace App\Services\Tweet;

use Illuminate\Database\Eloquent\Collection;

use App\Models\User\Tweet as UserTweet;

/**
 * ツイートのJSON関連
 */
class JsonService
{
    /** ツイート一覧をJson用の配列に変換 */
    public function tweetsToJsonArray(Collection $tweets): array
    {
        $arr = [];

        foreach ($tweets as $tweet) {
            $arr[] = $this->tweetToJsonArray($tweet);
        }

        return $arr;
    }

    /** ツイートをJson用の配列に変換 */
    public function tweetToJsonArray(UserTweet $tweet): array
    {
        return [
            'id' => $tweet->id,
            'content' => $tweet->content,
            'created_at' => $tweet->created_at,
            'user' => [
                'id' => $tweet->user->id,
                'name' => $tweet->user->name,
            ]
        ];
    }
}
