@extends('layouts.background_verde')
@section('title','Recuperar Senha')
@section('content')

<div class="container" style="background-color:#12583C;">
  <br><br><br>

  <div class="panel panel-default col-md-6 col-md-offset-3 sombra">
    <div class="panel-heading text-center">
      <h2>
        <strong>
          Recuperação de Senha
        </strong>
      </h2>
    </div>

    <div class="panel-body">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-12 control-label">E-Mail <font color="red">*</font> </label>

          <div class="col-md-12">
            <input id="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 text-center" style="padding-top:20px;">
            <button style="width:auto;" type="submit" class="btn btn-primary">
              Enviar e-mail
            </button>
          </div>
        </div>

      </form>
    </div>
  </div>

</div>

@endsection
