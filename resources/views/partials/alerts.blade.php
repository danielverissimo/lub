@if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <strong>Erro!</strong> {!! $error !!}
            </div>
        @endforeach
@endif

@if(Session::has('flash_notification.message'))
    <div class="alert alert-{!! session('flash_notification.level') !!} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <em>{!! session('flash_notification.message') !!}</em>
    </div>
@endif