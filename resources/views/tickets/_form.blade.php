{{--
    $organizationId and $userIds are set in /app/Providers/AppServiceProvider.php
--}}

<div class="form-group">
    {!! Form::label('organization_id', 'Organization:') !!}
    {!! Form::select('organization_id', $organizations, $organizationId, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('user_list', 'Whom to notify:') !!}
    {!! Form::select('user_list[]', $users, $userIds, ['id' => 'user_list', 'class' => 'form-control', 'multiple']) !!}
</div>

@if (isset($action) && $action == 'create')

    <div class="form-group">
        {!! Form::checkbox('notify', 1, null, ['id' => 'notify']) !!}
        {!! Form::label('notify', 'Add Public Notification Email') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Add Ticket', ['class' => 'btn btn-green']) !!}
        <a class="btn btn-white" href="{{ action('TicketsController@index') }}">Nevermind</a>
    </div>

@elseif (isset($action) && $action == 'edit')

    <div class="form-group">
        {!! Form::submit('Update Ticket', ['class' => 'btn btn-blue']) !!}
        <a class="btn btn-white" href="{{ action('TicketsController@show', $ticket->id) }}">Nevermind</a>
    </div>

@endif

@include ('errors.form')

@section('footer')
    <script>
        $('#user_list').select2({
            'tags': true,
            'placeholder': 'choose a user'/*,
            data: [
                { id: 'one', text: 'One' },
                { id: 'two', text: 'Two' }
            ],
            ajax: {
                dataType: 'json',
                url: 'api/tags',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    }
                },
                processResults: function(data) {
                    return { results: data }
                }
            }*/
        });
    </script>
@endsection