@extends('layouts.principal')
@section('title','Meus Dados')

@section('navbar')
<a href="{{ route("home") }}">Início</a> >
Meus dados
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Meus Dados
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">
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
            <form method="POST" action="{{ route("usuario.atualizar") }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-12 control-label">Nome</label>

                <div class="col-md-12">
                  @if(old('name',NULL) != NULL)
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                  @else
                  <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}" required autofocus>
                  @endif

                  @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-12 control-label">Nome de Usuário</label>

                <div class="col-md-12">
                  @if(old('username',NULL) != NULL)
                  <input id="username" type="username" class="form-control" name="username" value="{{old('username')}}">
                  @else
                  <input id="username" type="username" class="form-control" name="username" value="{{$usuario->username}}">
                  @endif

                  @if ($errors->has('username'))
                  <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-12 control-label">E-mail</label>

                <div class="col-md-12">
                  @if(old('email',NULL) != NULL)
                  <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}">
                  @else
                  <input id="email" type="email" class="form-control" name="email" value="{{$usuario->email}}">
                  @endif

                  @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                <label for="telefone" class="col-md-12 control-label">Telefone</label>

                <div class="col-md-12">
                  @if(old('telefone',NULL) != NULL)
                  <input type="text" name="telefone" id="telefone" minlength="10" placeholder="DDD+Telefone" maxlength="11" class="form-control" value="{{ old('telefone') }}">
                  @else
                  <input type="text" name="telefone" id="telefone" minlength="10" placeholder="DDD+Telefone" maxlength="11" class="form-control" value="{{ $usuario->telefone }}">
                  @endif

                  @if ($errors->has('telefone'))
                  <span class="help-block">
                    <strong>{{ $errors->first('telefone') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('senha') ? ' has-error' : '' }}">
                <label for="senha" class="col-md-12 control-label">Confirme sua senha</label>

                <div class="col-md-12">
                  <input type="password" name="senha" class="form-control">

                  @if ($errors->has('senha'))
                    <span class="help-block">
                      <strong>{{ $errors->first('senha') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="row col-md-12 text-center">
                  <br>

                  <div class="col-md-6">
                    <a href="{{route('usuario.editarSenha')}}">
                      Alterar Senha
                    </a>
                  </div>

                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                      Atualizar
                    </button>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
