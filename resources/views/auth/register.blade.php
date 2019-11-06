@extends('layouts.background_verde')
@section('title','Cadastrar')
@section('content')

<div class="container" style="background-color:#12583C;">

  <br><br><br>

  <div class="panel panel-default col-md-4 col-md-offset-4 sombra">
    <div class="panel-heading text-center">
      <h2>
        <strong>
          Cadastrar
        </strong>
      </h2>
    </div>

    <div class="panel-body">
      <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="name" class="col-md-12 control-label">Nome <font color="red">*</font></label>

          <div class="col-md-12">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
          <label for="username" class="col-md-12 control-label">Nome de usuário <font color="red">*</font> </label>

          <div class="col-md-12">
            <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}">

            @if ($errors->has('username'))
            <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-12 control-label">E-Mail</label>

          <div class="col-md-12">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
          <label for="telefone" class="col-md-12 control-label">Telefone <font color="red">*</font> </label>

          <div class="col-md-12">
            <input  type="digit" name="telefone" id="telefone" minlength="10" placeholder="DDD+Telefone" class="form-control"  maxlength="11" value="{{ old('telefone') }}">

            @if ($errors->has('telefone'))
            <span class="help-block">
              <strong>{{ $errors->first('telefone') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-12 control-label">Senha <font color="red">*</font> </label>

          <div class="col-md-12">
            <input id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label for="password-confirm" class="col-md-12 control-label">Confirme a senha <font color="red">*</font> </label>

          <div class="col-md-12">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 text-center" style="padding-top:20px;">
            <button id="submit"  type="submit" class="btn btn-primary">
              Cadastrar
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>


@endsection
