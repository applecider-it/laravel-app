<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ViewErrorBag;

use App\Models\User\Tweet;
use App\Services\Tweet\ListService;
use App\Services\Tweet\EditService;

/**
 * ツイート管理コントローラー (Railsライク)
 * 
 * ドキュメント
 * /documents/features/tweet.md
 */
class TweetRailsController extends Controller
{
    public function __construct(
        private ListService $listService,
        private EditService $editService,
    ) {}

    /** 一覧ページ */
    public function index(Request $request)
    {
        $searchWord = $request->input('search_word');
        $page = $request->input('page', 1);

        $tweets = $this->listService->getTweets($searchWord);

        $tweets = $tweets->paginate(5, page: $page)->onEachSide(1);
        $tweets->withQueryString();

        return view('tweet_rails.index', compact('tweets', 'searchWord', 'page'));
    }

    /** 新規作成 */
    public function create()
    {
        $tweet = new Tweet;
        return view('tweet_rails.create', compact('tweet'));
    }

    /** 追加処理 */
    public function store(Request $request)
    {
        $tweet = new Tweet;

        $validator = Validator::make(
            $request->all(),
            rules: [
                'content' => $tweet->validationContent(),
            ],
            attributes: [
                'content' => __('app.models.user/tweet.columns.content')
            ]
        );

        $data = $validator->getData();

        $tweet->content = $data['content'];

        if ($validator->fails()) {
            $errors = (new ViewErrorBag)->put('default', $validator->errors());
            return view('tweet_rails.create', compact('tweet', 'errors'));
        }

        $user = $request->user();

        $commit = $request->input('commit');
        $confirm = $request->input('confirm');

        Log::info('store', [$commit, $confirm]);

        if ($commit) {
            // 確定時

            $this->editService->newTweet($user, $tweet);

            return redirect()->back()->with('success', '投稿が作成されました');
        } else if ($confirm) {
            // 確認画面

            return view('tweet_rails.confirm', compact('tweet'));
        } else {
            // 戻るとき

            return view('tweet_rails.create', compact('tweet'));
        }
    }
}
