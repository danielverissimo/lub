@extends('layouts.app')

@section('content')


    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}"/>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <grid source="{{url('/users')}}" token="{{csrf_token()}}"></grid>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script type="text/javascript">

    </script>
@endsection
