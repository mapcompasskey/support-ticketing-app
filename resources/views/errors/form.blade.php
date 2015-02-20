@if (isset($errorBagName))
    @if ($errors->$errorBagName->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->$errorBagName->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@elseif ($errors->any())
    <div class="alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif