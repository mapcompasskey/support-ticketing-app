@if (env('APP_ENV') == 'local')
    {!! Html::style('css/fonts/glyphicons.css') !!}
    {!! Html::style('css/fonts/roboto.css') !!}
    {!! Html::style('css/app.css') !!}
@else
    {!! Html::style('css/app.min.css') !!}
@endif