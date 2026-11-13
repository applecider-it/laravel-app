<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    {!! $head ?? '' !!}
  </head>
  <body>
    <div class="email-wrapper">
      <div class="email-content">
        
        <!-- ヘッダー -->
        <div class="email-header">
          {!! $header ?? '' !!}
        </div>

        <!-- 本文（yield部分） -->
        <div class="email-body">
          <div>
            {!! Illuminate\Mail\Markdown::parse($slot) !!}
          </div>

          <div>
            {!! $subcopy ?? '' !!}
          </div>
        </div>

        <!-- フッター -->
        <div class="email-footer">
          {!! $footer ?? '' !!}
        </div>

      </div>
    </div>
  </body>
</html>
