@if (env('APP_ENV') == 'local')
    {!! Html::script('js/libs/jquery.min.js') !!}
    {!! Html::script('js/app.js') !!}
@else
    {!! Html::script('js/app.min.js') !!}
@endif