<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Post;

/**
 * 投稿管理コントローラー
 * 
 * ドキュメント
 * /documents/features/post.md
 */
class PostController extends Controller
{
    public function __construct(
    ) {}

    /** 一覧ページ */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);

        $posts = Post::latest();

        $posts = $posts->paginate(5, page: $page)->onEachSide(1);

        $posts->withQueryString();

        return view('posts.index', compact('posts'));
    }

    /** 詳細ページ */
    public function show(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('posts.show', compact('post'));
    }
}
