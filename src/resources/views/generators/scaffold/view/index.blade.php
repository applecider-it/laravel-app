<x#-app-layout>
    <x#-slot name="header">
        <h2 class="app-header-title">
            {{ $nameStudly }}一覧
        </h2>
    </x#-slot>

    <div class="app-container-lg">
        <div class="mb-4">
            <a href="{# route('admin.{{ $nameCamelPlural }}.create') #}" class="app-btn-primary">
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
