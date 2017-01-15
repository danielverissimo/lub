@extends('layouts.app')

@section('content')

    <section class="panel panel-default panel-tabs">
        @if ($item->exists)
            {!! Form::model($item, ['route' => ['roles.update', $item->id], 'method' => 'PUT']) !!}
        @else
            {!! Form::open(['url' => 'roles']) !!}
        @endif

        @include('partials.header_form', ['modelName' => 'Roles'])

        <div class="panel-body">

            <div role="tabpanel">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="active" role="presentation">
                        <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                            Roles
                        </a>
                    </li>

                    <li class="" role="permissions">
                        <a href="#permissions" aria-controls="permissions" role="tab" data-toggle="tab">
                            Permissões
                        </a>
                    </li>
                </ul>

                <div class="tab-content tab-bordered">

                    <div role="tabpanel" class="tab-pane fade in active" id="general">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

                                    {!! Form::label('name', 'Name:') !!}
                                    {{ Form::text('name', null, $attributes = $errors->has('name') ? array('class'=>'form-control error') : array('class'=>' form-control')) }}
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">

                                    {!! Form::label('display_name', 'Display_name:') !!}
                                    {{ Form::text('display_name', null, $attributes = $errors->has('display_name') ? array('class'=>'form-control error') : array('class'=>' form-control')) }}
                                    @if ($errors->has('display_name'))
                                        <span class="help-block">{{ $errors->first('display_name', ':message') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">

                                    {!! Form::label('description', 'Description:') !!}
                                    {{ Form::text('description', null, $attributes = $errors->has('description') ? array('class'=>'form-control error') : array('class'=>' form-control')) }}
                                    @if ($errors->has('description'))
                                        <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="permissions">

                        <fieldset>

                            <grid-relation
                                    path="roles"
                                    relation="permissions"
                                    model_id="{{$item->id}}"
                                    column="display_name"
                                    name="Permissão"
                                    model_name="Permissões"
                                    token="{{csrf_token()}}">
                            </grid-relation>

                        </fieldset>

                    </div>

                </div>

                {{-- Form actions --}}
                <div class="row">

                    <div class="col-lg-12">

                        {{-- Form actions --}}
                        <div class="form-group pull-right">

                            <button class="btn btn-success" type="submit">Salvar</button>

                            <a class="btn btn-default" href="{{{ url('/roles') }}}">Cancelar</a>

                            @if ($item->exists)
                                <a class="btn btn-danger" data-method="DELETE"
                                   data-action="{{ url("roles/{$item->id}") }}"
                                   data-token="{{csrf_token()}}">Excluir</a>
                            @endif

                        </div>

                    </div>

                </div>
            </div>

        </div>

        {!! Form::close() !!}
    </section>

@endsection