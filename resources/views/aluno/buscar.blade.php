@extends('layouts.principal')
@section('title','Buscar alunos')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> Buscar
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Buscar Aluno
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body">
          <form class="form-horizontal" method="GET" action="{{ route("aluno.buscarMatricula") }}">

            <div class="row" align="center">
              <div class="col-md-12">
                @if ($matricula == null)
                  <input style="width:74%" id="matricula" type="text" name="matricula" autofocus required placeholder="Matrícula do aluno">
                @else
                  <input style="width:74%" id="matricula" type="text" name="matricula" autofocus required placeholder="Matrícula do aluno" value="{{$matricula}}">
                @endif

                <button type="submit" class="btn btn-primary btn-md">
                  Buscar
                </button>
              </div>
            </div>
          </form>

          <br>

          @if(gettype($aluno) == 'array')

          @elseif($aluno == null)
            <div class="alert alert-danger">
              <strong> Nenhum resultado encontrado. </strong>
            </div>
          @else
            <div id="tabela" class="table-responsive">
              <table class="max-width table table-hover">

                <thead>
                  <tr>
                    <th>Resultado:</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td data-title="Nome" >{{ $aluno->nome }}</td>
                    <td>
                      @if(!$botaoAtivo)
                        <a class="btn btn-primary" style="width:auto;" href="{{ route("aluno.permissoes.requisitar", ["matricula" => $matricula]) }}">
                          Pedir permissão
                        </a>
                      @else
                        <a class="btn btn-primary" href="{{ route("aluno.gerenciar", ["id_aluno" => $aluno->id]) }}">
                          Gerenciar
                        </a>
                      @endif
                    </td>
                  </tr>
                </tbody>

              </table>
            </div>

          @endif

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

@endsection
