@extends('layouts.app')

@section('content')

    <section class="panel panel-default panel-tabs">
        {!! Form::model($item, ['url' => 'users', $item->id]) !!}

            @include('partials.header_form', ['submitButtonText' => 'Salvar', 'deleteButtonText' => 'Excluir'])

            <div class="panel-body">

                <div role="tabpanel">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active" role="presentation">
                            <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                                Usuário
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in active" id="general">

                            <fieldset>

                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

                                    {!! Form::label('name', 'Nome:') !!}
                                    {{ Form::text('name', null, $attributes = $errors->has('name') ? array('class'=>' form-control error') : array('class'=>' form-control')) }}
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                    @endif

                                </div>

                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                                    {!! Form::label('email', 'Email:') !!}
                                    {{ Form::text('email', null, $attributes = $errors->has('email') ? array('class'=>' form-control error') : array('class'=>' form-control')) }}
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                    @endif

                                </div>

                            </fieldset>

                        </div>

                    </div>

                </div>

            </div>

        {!! Form::close() !!}
    </section>

@endsection