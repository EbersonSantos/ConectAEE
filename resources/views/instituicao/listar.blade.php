@extends('layouts.principal')
@section('title','Listar Instituições')
@section('navbar')
<a href="{{route('instituicao.listar')}}">Instituições</a>
> Listar
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-8">
              <div style="width: 100%; margin-left: 0%;" class="row">
                <div style="width: 50%; float: left; margin-left:-20px;" class="col-md-6">
                  <h2>
                    <strong>
                      Instituições
                    </strong>
                  </h2>
                </div>
                <div style="width:50%; float:right; margin-right:-25px;" class="col-md-6">
                  <a class="btn btn-primary" style="float:right; margin-top:20px;" href="{{ route("instituicao.cadastrar")}}">
                    Nova Instituição
                  </a>
                </div>
              </div>
            </div>

            <div class="row col-md-4">
              @if(count($instituicoes) != 0 || $termo != null)
                <form class="form-horizontal" method="GET" action="{{ route("instituicao.buscar") }}">

                  <div id="divBusca" style="margin-top:20px;">

                  <i class="material-icons">search</i>

                  @if ($termo == null)
                    <input id="termo" type="text" autocomplete="off" name="termo" autofocus placeholder="Nome ou endereço">
                  @else
                    <input id="termo" type="text" autocomplete="off" name="termo" autofocus placeholder="Nome ou endereço" value="{{$termo}}">
                  @endif

                  <button id="btnBusca" type="submit">
                    Buscar
                  </button>
                  </div>
                </form>
              @endif
            </div>
          </div>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body">

          @if (\Session::has('success'))
            <br>
            <div class="alert alert-success">
              <strong>Sucesso!</strong>
              {!! \Session::get('success') !!}
            </div>
          @endif

          <div id="tabela" class="table-responsive">
            <table id="tabela_dados" class="table table-hover">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Ações</th>
                  <th></th>
                  <th></th>
                </tr>

              </thead>
              <tbody>
                @foreach ($instituicoes as $instituicao)
                  <tr>
                    <td data-title="Nome">{{ $instituicao->nome }}</td>
                    <td data-title="Ações">
                      <a class="btn btn-primary" href="{{ route("instituicao.ver" , ['id_instituicao' => $instituicao->id]) }}">
                        Visualizar
                      </a>
                    </td>
                    <td data-title="">
                      <a class="btn btn-primary" href="{{ route("instituicao.editar" , ['id_instituicao' => $instituicao->id]) }}">
                        Editar
                      </a>
                    </td>
                    <td data-title="">
                      <a class="btn btn-danger" onclick="return confirm('\A instituicao será desvinculada de qualquer aluno cadastrado com ela. Confirmar exclusão da instituicao {{$instituicao->nome}}? ')" href="{{ route("instituicao.excluir" , ['id_instituicao' => $instituicao->id]) }}">
                        Excluir
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- <div class="panel-footer">
          <a class="btn btn-danger" href="{{ route("home") }}">
            <i class="material-icons">keyboard_backspace</i>
            <br>
            Voltar
          </a>
        </div> -->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready( function () {

  $('#tabela_dados').DataTable( {
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
    },
    "columnDefs": [
      { "orderable": false, "targets": 1 },
      { "orderable": false, "targets": 2 },
      { "orderable": false, "targets": 3 }
    ]
  });

});
</script>

@endsection
