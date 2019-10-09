@extends('layouts.principal')
@section('title','Listar atividades')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href="{{route('objetivo.listar',$aluno->id)}}">Objetivos</a>
> <a href="{{route('objetivo.gerenciar',[$objetivo->id])}}"><strong>{{$objetivo->titulo}}</strong></a>
> Atividades
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Atividades</div>

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
                  <th>Título</th>
                  <th>Descrição</th>
                  <th>Prioridade</th>
                  <th>Status</th>
                  <th>Data</th>
                  @if($objetivo->user->id == \Auth::user()->id)
                    <th>Ações</th>
                    <th></th>
                    <th></th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($atividades as $atividade)
                  <tr>
                    <td data-title="Título">{{ $atividade->titulo }}</td>
                    <td data-title="Descrição">{{ $atividade->descricao }}</td>
                    <td data-title="Prioridade">{{ $atividade->prioridade }}</td>
                    <td data-title="Status">{{ $atividade->status }}</td>
                    <td data-title="Data">{{ $atividade->data }}</td>

                    @if($objetivo->user->id == \Auth::user()->id)
                      <td data-title="Ações">
                        <a class="btn btn-primary" href={{ route("atividade.editar" , ['id_atividade' => $atividade->id]) }}>
                          <i class="material-icons">edit</i>
                        </a>
                      </td>
                      <td data-title="">
                        <a class="btn btn-danger" onclick="return confirm('\Confirmar exclusão da atividade {{$atividade->titulo}}?')" href={{ route("atividade.excluir" , ['id_atividade' => $atividade->id]) }}>
                          <i class="material-icons">delete</i>
                        </a>
                      </td>
                      <td data-title="">
                        @if($objetivo->user->id == \Auth::user()->id && $atividade->concluido == false)
                          <a class="btn btn-success" href={{ route("atividade.concluir" , ['id_atividade' => $atividade->id]) }}>Concluir</a>
                        @elseif($objetivo->user->id == \Auth::user()->id && $atividade->concluido == true)
                          <a class="btn btn-danger" href={{ route("atividade.desconcluir" , ['id_atividade' => $atividade->id]) }}>Desconcluir</a>
                        @endif
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="panel-footer">
          <a class="btn btn-danger" href="{{ route("objetivo.gerenciar" , ['id_objetivo' => $objetivo->id]) }}">
            <i class="material-icons">keyboard_backspace</i>
            <br>
            Voltar
          </a>

          @if(App\Gerenciar::where('user_id','=',\Auth::user()->id)->where('aluno_id','=',$aluno->id)->first()->perfil_id != 1 && $objetivo->user->id == \Auth::user()->id)
            <a class="btn btn-success" href="{{ route("atividades.cadastrar" , ['id_objetivo' => $objetivo->id])}}">
              <i class="material-icons">add</i>
              <br>
              Novo
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready( function () {
  var colunas = tabela.getElementsByTagName('td').length / 2;

  if(colunas == 5){
    $('#tabela_dados').DataTable( {
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
      }
    });
  }else{
    $('#tabela_dados').DataTable( {
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
      },
      "columnDefs": [
        { "orderable": false, "targets": 5 },
        { "orderable": false, "targets": 6 },
        { "orderable": false, "targets": 7 },
      ]
    });
  }
});
</script>

@endsection
