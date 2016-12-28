@extends('layouts.app')

@section('content')

<section class="panel panel-default panel-tabs">
    {!! Form::model($item, ['method' => 'PATCH', 'action' => ['UserController@update', $item->id]]) !!}
    @include('users.form', ['submitButton' => 'Edit'])
    {!! Form::close() !!}
</section>

@endsection