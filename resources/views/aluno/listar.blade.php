@extends('layouts.principal')
@section('title','Listar alunos')
@section('path','Início')

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
                      Alunos
                    </strong>
                  </h2>
                </div>
                <div style="width:50%; float:right; margin-right:-15px;" class="col-md-6">
                  <a class="btn btn-primary" style="float:right; margin-top:20px;" href="{{ route("aluno.buscar")}}">
                    Novo Aluno
                  </a>
                </div>
              </div>
            </div>

            <div class="row col-md-4">
              @if(count($alunos) != 0 || $termo != null)
                <form class="form-horizontal" method="GET" action="{{ route("aluno.buscarAluno") }}">

                  <div id="divBusca" style="margin-top:20px;">

                  <i class="material-icons">search</i>

                  @if ($termo == null)
                    <input id="termo" type="text" autocomplete="off" name="termo" autofocus placeholder="Pesquise aqui...">
                  @else
                    <input id="termo" type="text" autocomplete="off" name="termo" autofocus placeholder="Pesquise aqui..." value="{{$termo}}">
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
            <div class="alert alert-success">
              <strong>Sucesso!</strong>
              {!! \Session::get('success') !!}
            </div>
          @endif

          @if (\Session::has('password'))
            <div class="alert alert-success">
              <strong>Sucesso!</strong>
              {!! \Session::get('password') !!}
            </div>
          @endif

          @if (\Session::has('denied'))
            <div class="alert alert-warning">
              <strong>Não permitido!</strong>
              {!! \Session::get('denied') !!}
            </div>
          @endif

          <div class="row" align="center">
            <table id="tabela_albuns" class="table-responsive">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php
                  $qtd_alunos = count($alunos);
                  $size = 6;
                @endphp

                @php($fim = count($alunos))

                      <tr>

                      @while(count($alunos) != 0)
                      @for($i = 1; $i <= $size; $i++ )

                        <td class="text-center">
                          @php($aluno = $alunos->shift())

                          @if($aluno != null)
                          @if($aluno->imagem != null)
                            <a style="border-radius: 60%;" href="{{ route("aluno.gerenciar",['id_aluno'=>$aluno->id]) }}#perfil">
                              <img src="{{asset('storage/avatars/'.$aluno->imagem)}}" style="border-radius: 60%; width:150px; height: 150px; object-fit: cover;">
                            </a>
                          @else
                            <a style="border-radius: 60%;" href="{{ route("aluno.gerenciar",['id_aluno'=>$aluno->id]) }}#perfil">
                              <img src="{{asset('images/avatar.png')}}" style="border-radius: 60%; width:150px; height: 150px; object-fit: cover;">
                            </a>
                          @endif

                          &nbsp; &nbsp;
                          <br><br>
                          <?php
                            $pieces = explode(" ", $aluno->nome);
                            // if(count($pieces) > 1){
                              // echo $pieces[0],' ',$pieces[1];
                            // }else{
                              echo $pieces[0];
                            // }
                          ?>
                          <br>
                          &nbsp; &nbsp;
                            </td>
                            @endif

                        @endfor
                      </tr>
                      @endwhile

              </tbody>
            </table>
          </div>

          @if($termo != "" && $qtd_alunos == 0)
            <div class="alert alert-danger">
              <strong> Nenhum aluno encontrado!</strong>
            </div>
          @elseif($qtd_alunos == 0)
            <div class="alert alert-info">
              <strong> Nenhum aluno cadastrado.</strong>
            </div>
          @endif

          <div class="text-center">
            {{$alunos->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

var width = screen.width;

if (width <= 1000){
	document.getElementById("painel").className = "col-md-offset-1";
}

</script>
@endsection
