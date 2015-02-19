@if (Session::has('flash_message'))
    <div class="alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif