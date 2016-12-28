@extends('layouts.app')

@section('content')

<section class="panel panel-default panel-tabs">
    {!! Form::open(['url' => 'users']) !!}
    @include('users.form', ['submitButton' => 'Create'])
    {!! Form::close() !!}
</section>

@endsection

@section('scripts')

    <script type="text/javascript">

        $(function() {


        });

    </script>


@endsection
