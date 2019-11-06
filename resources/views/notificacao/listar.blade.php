@extends('layouts.principal')
@section('title','Notificações')
@section('path','Início')

@section('navbar')
<a href="{{route('notificacao.listar')}}">Notificações</a> > Listar
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Suas notificações
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

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

          <div class="text-center">
            {{$notificacoes->links()}}
          </div>

          <!-- <a class="btn btn-danger" href="{{ route("home") }}">
            <i class="material-icons">keyboard_backspace</i>
            <br>
            Voltar
          </a> -->

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
