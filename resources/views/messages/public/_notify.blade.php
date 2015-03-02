@if ($ticket)

    <p>&nbsp</p>
    <p>&nbsp</p>
    <hr />

    <h3>Public Messages: Send Notification</h3>
    <hr />

    <p>This message will appear as the first public message. Its the easiest way to include a contact into the public thread.</p>
    <hr />

    @include ('messages.public._form', ['action' => 'notify'])

@endif