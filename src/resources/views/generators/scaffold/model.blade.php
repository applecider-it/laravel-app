<#php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * {{ $nameStudly }}モデル
 */
class {{ $nameStudly }} extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
@foreach ($columns as $row)
        '{{ $row['snake'] }}',
@endforeach
    ];
@foreach ($columns as $row)

    /** {{ $row['studly'] }}のバリデーション */
    public function validation{{ $row['studly'] }}()
    {
        return [
            'required',
        ];
    }
@endforeach

    /** キーワード検索用スコープ */
    public function scopeSearchKeyword($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
@foreach ($columns as $idx => $row)
@if ($idx === 0)
            $q->where('{{ $row['snake'] }}', 'like', "%{$keyword}%")
@else
                ->orWhere('{{ $row['snake'] }}', 'like', "%{$keyword}%")
@endif
@endforeach
            ;
        });
    }
}
