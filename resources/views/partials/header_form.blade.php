<header class="panel-heading">

    <nav class="navbar navbar-default navbar-actions">

        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <span class="navbar-brand">
                    @if ($item->exists)
                        Alterar {!! $modelName !!}
                    @else
                        Criar {!! $modelName !!}
                    @endif
                    <small></small>
                </span>
            </div>

        </div>

    </nav>

</header>