<x#-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">{{ $nameStudly }}一覧</h2>

        <div class="mb-4">
            <a href="{# route('{{ $nameSnakePlural }}.create') #}" class="app-btn-primary">
                新規作成
            </a>
        </div>

        ##include('partials.message.session')
        
        ##include('{{ $nameSnake }}.partials.search')

        ##include('{{ $nameSnake }}.partials.list')

        <div class="mt-4">
            {# ${{ $nameCamelPlural }}->links() #}
        </div>
    </div>
</x#-app-layout>
