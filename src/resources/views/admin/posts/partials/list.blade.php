<div class="app-table-container">
    <table class="app-table">
        <thead class="app-table-thead">
            <tr>
                <th class="app-table-th">ID</th>
                <th class="app-table-th">タイトル</th>
                <th class="app-table-th">Slug</th>
                <th class="app-table-th">投稿日時</th>
                <th class="app-table-th">作成日時</th>
                <th class="app-table-th">操作</th>
            </tr>
        </thead>
        <tbody class="app-table-tbody">
            @foreach($posts as $post)
                <tr>
                    <td class="app-table-td">{{ $post->id }}</td>
                    <td class="app-table-td">{{ $post->title }}</td>
                    <td class="app-table-td">{{ $post->slug }}</td>
                    <td class="app-table-td">{{ $post->published_at }}</td>
                    <td class="app-table-td">{{ $post->created_at }}</td>
                    <td class="app-table-td flex space-x-2">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="app-btn-primary app-btn-small">
                            編集
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
