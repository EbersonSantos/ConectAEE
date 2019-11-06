@extends('layouts.principal')
@section('title','Alterar Senha')
@section('path','Início')
@section('navbar')
<a href="{{ route("home") }}">Início</a> >
<a href="{{ route("usuario.editar") }}">Meus Dados</a> >
Alterar Senha
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Alterar Senha</div>

        <div class="panel-body">
          @if (\Session::has('success'))
            <div class="alert alert-success">
              <strong>Sucesso!</strong>
              {!! \Session::get('success') !!}
            </div>
          @elseif (\Session::has('fail'))
            <div class="alert alert-danger">
              <strong>Erro!</strong>
              {!! \Session::get('fail') !!}
            </div>
          @endif

          <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route('usuario.atualizarSenha') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('senha_atual') ? ' has-error' : '' }}">
                <label for="senha_atual" class="col-md-12 control-label">Senha atual <font color="red">*</font> </label>

                <div class="col-md-12">
                  <input id="senha_atual" type="password" class="form-control" name="senha_atual" value="{{ old('senha_atual') }}">

                  @if ($errors->has('senha_atual'))
                  <span class="help-block">
                    <strong>{{ $errors->first('senha_atual') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('nova_senha') ? ' has-error' : '' }}">
                <label for="nova_senha" class="col-md-12 control-label">Nova senha <font color="red">*</font> </label>

                <div class="col-md-12">
                  <input id="nova_senha" type="password" class="form-control" name="nova_senha" value="{{ old('nova_senha') }}">

                  @if ($errors->has('nova_senha'))
                  <span class="help-block">
                    <strong>{{ $errors->first('nova_senha') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('nova_senha_confirm') ? ' has-error' : '' }}">
                <label for="nova_senha_confirm" class="col-md-12 control-label">Confirme nova senha <font color="red">*</font> </label>

                <div class="col-md-12">
                  <input id="nova_senha_confirm" type="password" class="form-control" name="nova_senha_confirm" value="{{ old('nova_senha_confirm') }}">

                  @if ($errors->has('nova_senha_confirm'))
                  <span class="help-block">
                    <strong>{{ $errors->first('nova_senha_confirm') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="row col-md-12 text-center">
                  <br>
                  <button type="submit" class="btn btn-primary">
                    Atualizar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- <div class="panel-footer">
          <a class="btn btn-danger" href="{{URL::previous()}}">
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
