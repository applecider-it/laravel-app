<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Services\Admin\Post\ListService;

/**
 * 投稿管理コントローラー
 */
class PostController extends Controller
{
    public function __construct(
        private ListService $listService,
    ) {}

    /** 一覧 */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = $this->listService->getPosts($search);

        // 検索条件を保持したままページネーション
        $posts = $query->paginate(5)->onEachSide(2)->withQueryString();

        return view('admin.posts.index', compact('posts', 'search'));
    }

    /** 新規作成 */
    public function create()
    {
        $post = new Post();
        return view('admin.posts.create', compact('post'));
    }

    /** 登録処理 */
    public function store(Request $request)
    {
        $post = new Post();
        $validated = $request->validate(
            rules: [
                'title' => $post->validationTitle(),
                'slug' => $post->validationSlug(),
                'content' => $post->validationContent(),
                'published_at' => $post->validationPublishedAt(),
            ],
            attributes: [
                'title' => __('app.models.post.columns.title'),
                'slug' => __('app.models.post.columns.slug'),
                'content' => __('app.models.post.columns.content'),
                'published_at' => __('app.models.post.columns.published_at'),
            ]
        );

        $post = Post::create($validated);

        return redirect()->route('admin.posts.edit', $post)->with('success', '投稿を作成しました');
    }

    /** 編集 */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /** 更新処理 */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate(
            rules: [
                'title' => $post->validationTitle(),
                'slug' => $post->validationSlug(),
                'content' => $post->validationContent(),
                'published_at' => $post->validationPublishedAt(),
            ],
            attributes: [
                'title' => __('app.models.post.columns.title'),
                'slug' => __('app.models.post.columns.slug'),
                'content' => __('app.models.post.columns.content'),
                'published_at' => __('app.models.post.columns.published_at'),
            ]
        );

        $post->update($validated);

        return redirect()->route('admin.posts.edit', $post)->with('success', '投稿を更新しました');
    }

    /** 削除 */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', '投稿を削除しました');
    }
}
