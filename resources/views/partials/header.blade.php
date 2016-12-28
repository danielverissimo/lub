<div class="container">

    <a href="/" id="logo" class="navbar-brand">
        <div>
            <img alt="" src="" title="@setting('platform.app.title')" style="margin-left: 10px;">
        </div>
    </a>

    <div class="clearfix">
        <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
        </button>

        <div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
            <ul class="nav navbar-nav pull-left">
                <li>
                    <a class="btn" id="make-small-nav">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-no-collapse pull-right" id="header-nav">

            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-user visible-xs-inline"></i>
                        <span class="hidden-xs">User Email</span>
                        <span class="caret" style="border-top-color:#484848;"></span>
                    </a>

                    <ul class="dropdown-menu centaurus" role="menu">
                        <li>
                            <a href="{{ url('/logout') }}">
                                <i class="fa fa-power-off"></i> Sair
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="hidden-xxs">
                    <a class="btn" href="{{ url('/logout') }}">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>