<div class="app-table-container">
    <table class="app-table">
        <thead class="app-table-thead">
            <tr>
                <th class="app-table-th">ID</th>
@foreach ($columns as $row)
                <th class="app-table-th">{{ $row['studly'] }}</th>
@endforeach
                <th class="app-table-th">作成日時</th>
                <th class="app-table-th">操作</th>
            </tr>
        </thead>
        <tbody class="app-table-tbody">
            ##foreach(${{ $nameCamelPlural }} as ${{ $nameCamel }})
                <tr>
                    <td class="app-table-td">{# ${{ $nameCamel }}->id #}</td>
@foreach ($columns as $row)
                    <td class="app-table-td">{# ${{ $nameCamel }}->{{ $row['snake'] }} #}</td>
@endforeach
                    <td class="app-table-td">{# ${{ $nameCamel }}->created_at #}</td>
                    <td class="app-table-td flex space-x-2">
                        <a href="{# route('{{ $nameSnakePlural }}.edit', ${{ $nameCamel }}) #}" class="app-btn-primary app-btn-small">
                            編集
                        </a>
                    </td>
                </tr>
            ##endforeach
        </tbody>
    </table>
</div>
