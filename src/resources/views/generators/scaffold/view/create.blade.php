<x#-app-layout>
    <x#-slot name="header">
        <h2 class="app-header-title">
            {{ $nameStudly }}作成
        </h2>
    </x#-slot>

    <div class="app-container-lg">
        <div class="mb-6">
            <a href="{# route('{{ $nameCamelPlural }}.index') #}" class="app-btn-secondary">
                一覧に戻る
            </a>
        </div>

        ##include('partials.form.errors')

        <form method="POST" action="{# route('{{ $nameCamelPlural }}.store') #}" class="app-form">
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
