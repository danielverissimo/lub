@extends('layouts.app')

@section('content')


    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}"/>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <grid source="{{url('/permissions')}}" token="{{csrf_token()}}" name="Permissions"></grid>
            </div>
        </div>
    </div>

@endsection