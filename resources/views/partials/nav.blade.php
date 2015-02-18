<nav class="navbar">
    <div class="navbar-inner clearfix">

        <div class="navbar-header">
            <!--button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button-->
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