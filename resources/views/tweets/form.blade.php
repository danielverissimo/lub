@extends('layouts.app')

@section('content')

    <section class="panel panel-default panel-tabs">
        @if ($item->exists)
            {!! Form::model($item, ['route' => ['tweets.update', $item->id], 'method' => 'PUT']) !!}
        @else
            {!! Form::open(['url' => 'tweets']) !!}
        @endif

        @include('partials.header_form', ['modelName' => 'Tweets'])

        <div class="panel-body">

            <div role="tabpanel">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="active" role="presentation">
                        <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                            Tweets
                        </a>
                    </li>
                </ul>

                <div class="tab-content tab-bordered">

                    <div role="tabpanel" class="tab-pane fade in active" id="general">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                                    {!! Form::label('title', 'Title:') !!}
                                    {{ Form::text('title', null, $attributes = $errors->has('title') ? array('class'=>'form-control error') : array('class'=>' form-control')) }}
                                    @if ($errors->has('title'))
                                        <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">

                                    {!! Form::label('body', 'Body:') !!}
                                    {{ Form::textarea('body', null, $attributes = $errors->has('body') ? array('class'=>' form-control error') : array('class'=>' form-control')) }}
                                    @if ($errors->has('body'))
                                        <span class="help-block">{{ $errors->first('body', ':message') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('count') ? 'has-error' : '' }}">

                                    {!! Form::label('count', 'Count:') !!}
                                    {{ Form::number('count', null, $attributes = $errors->has('count') ? array('class'=>'form-control error') : array('class'=>' form-control')) }}
                                    @if ($errors->has('count'))
                                        <span class="help-block">{{ $errors->first('count', ':message') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">

                                            {!! Form::label('Date', 'Date:') !!}
                                            <div class="input-group">
                                                <div style="position: relative">
                                                    {{ Form::text('date', $item->date, $attributes = $errors->has('date') ? array('class'=>'form-control error date-picker mask', 'data-mask' => '00/00/0000') : array('class'=>'form-control date-picker mask', 'data-mask' => '00/00/0000')) }}
                                                </div>
                                                @if ($errors->has('date'))
                                                    <span class="help-block">{{ $errors->first('date', ':message') }}</span>
                                                @endif
                                                <span class="input-group-addon" id="button-picker"
                                                      style="cursor:pointer;"/>
                                                <span class="fa fa-calendar"></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">

                                    <label for="user_id_name" class="control-label">User
                                        <i class="fa fa-info-circle"
                                           data-toggle="popover"
                                           data-content="Informe User aqui"
                                           data-original-title="User" title="User"></i>
                                    </label>
                                    <div class="input-group">

                                        <div style="position: relative">
                                            {{ Form::text('user_id_name', $item->exists ? $item->user->name : null, $attributes = $errors->has('user_id') ? array('class'=>' form-control error', 'readonly' => 'true') : array('class'=>' form-control', 'readonly' => 'true')) }}
                                            {{ Form::hidden('user_id', $item->exists ? $item->user->id : null) }}
                                        </div>

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#grid-modal-user_id">
                                                <i class="fa fa-search"></i> Buscar
                                            </button>
                                            <button type="button" class="btn btn-danger clear-data">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </span>

                                    </div>

                                    @if ($errors->has('user_id'))
                                        <span class="help-block">{{ $errors->first('user_id', ':message') }}</span>
                                    @endif

                                    <script type="text/javascript">

                                        function modalSelectItem_User_id(item) {
                                            $('input[name=user_id_name]').val(item.name);
                                            $('input[name=user_id]').val(item.id);
                                        }

                                    </script>

                                    <grid-modal
                                            id="grid-modal-user_id"
                                            source="{{url('/users')}}"
                                            token="{{csrf_token()}}"
                                            name="Users"
                                            callback="modalSelectItem_User_id">
                                    </grid-modal>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                {{-- Form actions --}}
                <div class="row">

                    <div class="col-lg-12">

                        <div class="form-group pull-left">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#grid-modal-revision">
                                <i class="fa fa-file-text-o"></i> Revisão
                            </button>
                        </div>

                        {{-- Form actions --}}
                        <div class="form-group pull-right">

                            <button class="btn btn-success" type="submit">Salvar</button>

                            <a class="btn btn-default" href="{{{ url('/tweets') }}}">Cancelar</a>

                            @if ($item->exists)
                                <a class="btn btn-danger" data-method="DELETE"
                                   data-action="{{ url("tweets/{$item->id}") }}"
                                   data-token="{{csrf_token()}}">Excluir</a>
                            @endif

                        </div>

                    </div>

                </div>
            </div>

        </div>

        <grid-modal
                id="grid-modal-revision"
                source="{{url('/revisions')}}"
                token="{{csrf_token()}}"
                name="Revisions"
                style_modal="width: 1000px;"
                class_filter="App\Models\Tweet">
        </grid-modal>

        {!! Form::close() !!}
    </section>

@endsection