<#php

namespace App\Http\Controllers;

use App\Models\{{ $nameStudly }};
use Illuminate\Http\Request;

use App\Services\{{ $nameStudly }}\ListService;

/**
 * {{ $nameStudly }}コントローラー
 */
class {{ $nameStudly }}Controller extends Controller
{
    public function __construct(
        private ListService $listService,
    ) {}

    /** 一覧 */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = $this->listService->get{{ $nameStudlyPlural }}($search);

        // 検索条件を保持したままページネーション
        ${{ $nameCamelPlural }} = $query->paginate(5)->onEachSide(2)->withQueryString();

        return view('{{ $nameSnake }}.index', compact('{{ $nameCamelPlural }}', 'search'));
    }

    /** 新規作成 */
    public function create()
    {
        ${{ $nameCamel }} = new {{ $nameStudly }}();
        return view('{{ $nameSnake }}.create', compact('{{ $nameCamel }}'));
    }

    /** 登録処理 */
    public function store(Request $request)
    {
        ${{ $nameCamel }} = new {{ $nameStudly }}();
        $validated = $request->validate(
            rules: [
@foreach ($columns as $row)
                '{{ $row['snake'] }}' => ${{ $nameCamel }}->validation{{ $row['studly'] }}(),
@endforeach
            ],
            attributes: [
@foreach ($columns as $row)
                '{{ $row['snake'] }}' => __('app.models.{{ $nameSnake }}.columns.{{ $row['snake'] }}'),
@endforeach
            ]
        );

        ${{ $nameCamel }} = {{ $nameStudly }}::create($validated);

        return redirect()->route('{{ $nameSnake }}.edit', ${{ $nameCamel }})->with('success', '{{ $nameStudly }}を作成しました');
    }

    /** 編集 */
    public function edit({{ $nameStudly }} ${{ $nameCamel }})
    {
        return view('{{ $nameSnake }}.edit', compact('{{ $nameCamel }}'));
    }

    /** 更新処理 */
    public function update(Request $request, {{ $nameStudly }} ${{ $nameCamel }})
    {
        $validated = $request->validate(
            rules: [
@foreach ($columns as $row)
                '{{ $row['snake'] }}' => ${{ $nameCamel }}->validation{{ $row['studly'] }}(),
@endforeach
            ],
            attributes: [
@foreach ($columns as $row)
                '{{ $row['snake'] }}' => __('app.models.{{ $nameSnake }}.columns.{{ $row['snake'] }}'),
@endforeach
            ]
        );

        ${{ $nameCamel }}->update($validated);

        return redirect()->route('{{ $nameSnake }}.edit', ${{ $nameCamel }})->with('success', '{{ $nameStudly }}を更新しました');
    }

    /** 削除 */
    public function destroy({{ $nameStudly }} ${{ $nameCamel }})
    {
        ${{ $nameCamel }}->delete();

        return redirect()->route('{{ $nameSnake }}.index')->with('success', '{{ $nameStudly }}を削除しました');
    }
}
