@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <strong>Erro!</strong> Por favor, verifique os erros no formulário abaixo.
    </div>
@endif

@if(Session::has('flash_notification.message'))
    <div class="alert alert-{!! session('flash_notification.level') !!} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <em>{!! session('flash_notification.message') !!}</em>
    </div>
@endif