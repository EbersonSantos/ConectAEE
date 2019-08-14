@extends('layouts.principal')
@section('title','Notificações')
@section('path','Início')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Suas notificações</div>

        <div class="panel-body">
          <div id="tabela" class="table-responsive">
            <table id="tabela_dados" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($notificacoes as $notificacao)
                <tr>
                  @if($notificacao->lido)
                  <td data-title="Notificacao">
                    @else
                    <td class="bg-info" data-title="Notificacao">
                      @endif
                      <a class="btn text-center" href="{{ route('aluno.permissoes.conceder', ['id_aluno' => $notificacao->aluno->id, 'id_notificacao' => $notificacao->id]) }}">
                        Você tem um pedido de acesso de {{$notificacao->remetente->name}} ao aluno {{$notificacao->aluno->nome}}
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="panel-footer">
            <a class="btn btn-danger" href="{{ route("home") }}">
              <i class="material-icons">keyboard_backspace</i>
              <br>
              Voltar
            </a>
            <a class="btn btn-success" href="{{ route("aluno.cadastrar")}}">
              <i class="material-icons">add</i>
              <br>
              Novo
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  $(document).ready( function () {
    $('#tabela_dados').DataTable( {
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
      }
    });
  });
</script>


@endsection
