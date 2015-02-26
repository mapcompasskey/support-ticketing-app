<nav class="navbar">
    <div class="navbar-inner clearfix">

        <div class="navbar-header">
            <a class="navbar-brand" href="/">Support App</a>
        </div>

        <div class="navbar-nav">
            <ul>
                <li	class="{{ (Request::segment(1) == 'organizations' ? 'active' : '') }}">
                    <a href="/organizations">Organizations</a>
                </li>
                <li	class="{{ (Request::segment(1) == 'tickets' ? 'active' : '') }}">
                    <a href="/tickets">Tickets</a>
                </li>
            </ul>
        </div>

    </div>
</nav>