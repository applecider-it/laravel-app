<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\User\Tweet as UserTweet;
use App\Services\WebSocket\AuthService as WebSocketAuthService;
use App\Services\Channels\TweetChannel;
use App\Services\Tweet\EditService;
use App\Services\Tweet\JsonService;

/**
 * ツイート(JS)管理コントローラー
 * 
 * ドキュメント
 * /documents/features/tweet.md
 */
class TweetJsController extends Controller
{
    public function __construct(
        private WebSocketAuthService $webSocketAuthService,
        private EditService $editService,
        private JsonService $jsonService,
    ) {}

    /** 一覧ページ(JS) */
    public function index(Request $request)
    {
        $user = $request->user();
        $tweets = UserTweet::with('user')->latest()->take(20)->get();

        $token = $this->webSocketAuthService->createUserJwt($user, TweetChannel::getChannel());

        $tweetsJsonArray = $this->jsonService->tweetsToJsonArray($tweets);

        return view('tweet_js.index', compact('tweetsJsonArray', 'token', 'user'));
    }

    /** Tweet追加処理 */
    public function store(Request $request)
    {
        //usleep(1000 * 1000 * 3);

        $tweet = new UserTweet();
        $validated = $request->validate(
            rules: [
                'content' => $tweet->validationContent(),
            ],
            attributes: [
                'content' => __('app.models.user/tweet.columns.content')
            ]
        );

        $user = $request->user();
        $tweet->content = $validated['content'];

        $this->editService->newTweet($user, $tweet);

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
