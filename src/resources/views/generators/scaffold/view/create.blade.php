<x#-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">{{ $nameStudly }}作成</h2>

        <div class="mb-6">
            <a href="{# route('{{ $nameSnakePlural }}.index') #}" class="app-btn-secondary">
                一覧に戻る
            </a>
        </div>

        ##include('partials.form.errors')

        <form method="POST" action="{# route('{{ $nameSnakePlural }}.store') #}" class="app-form">
            ##csrf

            ##include('{{ $nameSnake }}.partials.form')

            <div class="pt-4">
                <button type="submit" class="app-btn-primary">
                    作成
                </button>
            </div>
        </form>
    </div>
</x#-app-layout>
