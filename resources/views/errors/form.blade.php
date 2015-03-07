@if ($errors->default->any())
    <div class="alert-danger">
        <a id="form-errors" class="anchor-offset"></a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif