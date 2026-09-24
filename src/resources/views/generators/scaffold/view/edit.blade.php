<x#-app-layout>
    <x#-slot name="header">
        <h2 class="app-header-title">
            {{ $nameStudly }}編集
        </h2>
    </x#-slot>

    <div class="app-container-lg">
        <div class="mb-6">
            <a href="{# route('{{ $nameSnakePlural }}.index') #}" class="app-btn-secondary">
                一覧に戻る
            </a>
        </div>

        ##include('partials.form.errors')

        ##include('partials.message.session')

        <form method="POST" action="{# route('{{ $nameSnakePlural }}.update', ${{ $nameCamel }}) #}" class="app-form">
            ##csrf
            ##method('PUT')

            ##include('{{ $nameSnake }}.partials.form')

            <div>
                <label for="name" class="app-form-label">作成日時</label>
                {# ${{ $nameCamel }}->created_at #}
            </div>

            <div>
                <label for="name" class="app-form-label">更新日時</label>
                {# ${{ $nameCamel }}->updated_at #}
            </div>

            <div class="pt-4">
                <button type="submit" class="app-btn-primary">
                    更新
                </button>
            </div>
        </form>

        <div class="mt-20">
            <div class="flex justify-between items-center">
                <div>
                    削除
                </div>
                <div>
                    <form method="POST" action="{# route('{{ $nameSnakePlural }}.destroy', ${{ $nameCamel }}) #}"
                    onsubmit="return confirm('削除してもよろしいですか？')">
                        ##csrf
                        ##method('DELETE')
                        <button type="submit" class="app-btn-danger">
                            削除
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x#-app-layout>
