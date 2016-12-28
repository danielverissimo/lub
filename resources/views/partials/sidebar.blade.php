<section id="col-left" class="col-left-nano">
    <div id="col-left-inner" class="col-left-nano-content">
        <div id="user-left-box" class="clearfix hidden-sm hidden-xs">
            <div class="user-box">
				<span class="name">
                    Daniel
				</span>
                <span class="status">
					<i class="fa fa-circle"></i> Online
				</span>
            </div>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="{{ url('/home') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                        <span class="label label-info label-circle pull-right"></span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-table"></i>
                        <span>Acesso</span>
                        <i class="fa fa-chevron-circle-right drop-icon"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ url('/users') }}">
                                Usuário
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</section>