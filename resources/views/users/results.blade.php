<div id="grid_result">
    @foreach ($paginator as $p)
        <tr>
            <td>{!! $p->name !!}</td>
            <td>{!! $p->email !!}</td>
            <td style="width: 20%;">
                <a href="/users/{{$p->id}}/edit" class="table-link" title="Editar">
                    <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
                <a href="{!! url('/users', $p->id) !!}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Tem certeza que deseja excluir o registro '{!! $p->name !!}'?">
                    <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </td>
        </tr>
    @endforeach
</div>