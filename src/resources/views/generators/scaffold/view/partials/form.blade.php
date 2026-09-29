@foreach ($columns as $row)
<div>
    <label for="{{ $row['snake'] }}" class="app-form-label">{{ $row['studly'] }}</label>
    <input type="text" name="{{ $row['snake'] }}" id="{{ $row['snake'] }}" value="{# old('{{ $row['snake'] }}', ${{ $nameCamel }}->{{ $row['snake'] }}) #}" class="mt-1 app-form-input">
    ##error('{{ $row['snake'] }}')
        <p class="app-error-text">{# $message #}</p>
    ##enderror
</div>

@endforeach
