@extends('layouts.background_verde')
@section('title','Redefinir Senha')
@section('content')
<div class="container" style="background-color:#12583C;">
  <br><br><br>

  <div class="panel panel-default col-md-6 col-md-offset-3 sombra">
    <div class="panel-heading text-center">
      <h2>
        <strong>
          Redefinir Senha
        </strong>
      </h2>
    </div>

    <div class="panel-body panel-body-cadastro">
      <form method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-12 control-label">E-mail <font color="red">*</font> </label>

          <div class="col-md-12">
            <input id="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
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

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label for="password-confirm" class="col-md-12 control-label">Confirmação de senha <font color="red">*</font> </label>

          <div class="col-md-12">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

            @if ($errors->has('password_confirmation'))
              <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 text-center" style="padding-top:20px;">
            <button type="submit" class="btn btn-primary">
              Redefinir
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
