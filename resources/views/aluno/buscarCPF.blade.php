@extends('layouts.principal')
@section('title','Novo aluno')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> Novo Aluno
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Novo Aluno
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">
          <div class="col-md-8 col-md-offset-2">
            <form method="GET" action="{{ route("aluno.buscarCPF") }}">

              <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                <label for="cpf" class="col-md-12 control-label"> Informe o CPF do aluno: <font color="red">*</font></label>

                <div class="col-md-12">
                  @if ($cpf == null)
                    <input id="cpf" type="text" class="form-control" placeholder="000.000.000-00" name="cpf">
                  @else
                    <input id="cpf" type="text" class="form-control" placeholder="000.000.000-00" name="cpf" value="{{$cpf}}">
                  @endif

                  @if ($errors->has('cpf'))
                    <span class="help-block">
                      <strong>{{ $errors->first('cpf') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="row col-md-12 text-center">
                  <br>
                  <button type="submit" class="btn btn-primary">
                    Enviar
                  </button>
                </div>
              </div>

            </form>
          </div>
        </div>

        <div class="panel-body">
          @if($aluno != null)

          <div class="alert alert-info text-center">
            <strong>
              O aluno {{ $aluno->nome }} já está cadastrado no sistema.
              @if(!$botaoAtivo)
                <a class="btn btn-primary" style="width:auto;" href="{{ route("aluno.permissoes.requisitar", ["cpf" => $cpf]) }}">
                  Pedir Permissão de Acesso
                </a>
              @else
                <a class="btn btn-primary" href="{{ route("aluno.gerenciar", ["id_aluno" => $aluno->id]) }}">
                  Ver Perfil
                </a>
              @endif
            </strong>
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
