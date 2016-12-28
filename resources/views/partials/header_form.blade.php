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

                <ul class="nav navbar-nav navbar-cancel">
                    <li>
                        <a class="tip" href="{{ URL::previous() }}" data-toggle="tooltip" data-original-title="Cancelar">
                            <i class="fa fa-reply"></i> <span class="visible-xs-inline">Cancelar</span>
                        </a>
                    </li>
                </ul>

                <span class="navbar-brand">Criar <small></small></span>
            </div>

            <div class="collapse navbar-collapse" id="actions">

                <ul class="nav navbar-nav navbar-right">

                    <li>

                        <button type="button"
                                data-toggle="tooltip"
                                data-original-title="Salvar"
                                data-method="delete"
                                data-token="{{csrf_token()}}"
                                data-confirm="Tem certeza que deseja excluir o registro?"
                                class="btn btn-primary navbar-btn"
                                style="margin-right: 5px;"
                                action="{!! url('/users', $item->id) !!}">
                            <i class="fa fa-trash"></i>
                            <span class="visible-xs-inline">$deleteButtonText</span>
                        </button>

                    </li>

                    <li>
                        {!! Form::button(
                            '<i class="fa fa-save"></i> <span class="visible-xs-inline">Salvar</span>',
                            ['type' => 'submit',
                             'class' => 'btn btn-primary navbar-btn',
                             'data-toggle' => 'tooltip',
                             'data-original-title' => $submitButtonText
                            ])
                         !!}
                    </li>

                </ul>

            </div>

        </div>

    </nav>

</header>