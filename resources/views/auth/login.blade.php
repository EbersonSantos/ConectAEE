@extends('layouts.background_branco')
@section('title','Entrar')
@section('content')

<div class="row" style="background-color:#12583C; padding:10px;">
  <br>
  <div class="col-md-8">
    <div class="panel panel-default" style="width:100%;background-color:#12583C;">

      <div class="panel-body col-md-12 texto">
        <h1> <strong>ConectAEE</strong> </h1>
        <hr>
        <p class="text-justify">
          Sendo um sistema pensado para que a educação inclusiva seja uma realidade nas escolas e
          instituições de ensino do Brasil, o ConectAAE dá suporte ao acompanhamento de alunos
          que necessitam de Atendimento Educacional Especializado (AEE), permitindo uma maior
          integração entre escola, família e profissionais da Saúde, uma vez que a troca de informações
          entre cada um desses indivíduos é indispensável.
        </p>
      </div>

    </div>
  </div>

  <div class="col-md-3">
    <div class="panel panel-default" style="padding:20px;" >
      <div class="panel-heading text-center">
        <h2>
          <strong>
            Entrar
          </strong>
        </h2>
      </div>

      <div class="panel-body">
        <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('username') || $errors->has('email') ? ' has-error' : '' }}">
            <label for="login" class="col-md-12 control-label text-left">Usuário ou e-mail:</label>

            <div class="col-md-12">
              <input id="login" type="text" class="form-control" name="login" value="{{ old('username') ?: old('email') }}" autofocus>

              @if ($errors->has('username') || $errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-12 control-label">Senha:</label>

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
            <div class="col-md-12">
              <div class="checkbox">
                <label style="font-size:14px">
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                  Lembrar usuário/e-mail e senha
                </label>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                  &nbsp; Esqueceu sua senha?
                </a>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-10 col-md-offset-1">
              <div style="width: 100%; margin-left: 0%" class="row">
                <div style="width: 50%; float: left" class="column col-md-6">
                  <a href="{{ route('register') }}">
                    <strong>
                      Cadastrar
                    </strong>
                  </a>
                </div>
                <div style="width: 50%; float: left" class="column col-md-6">
                  <button type="submit" class="btn btn-primary">
                    Entrar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<div class="row" style="padding:20px; background-color:#FFFFFF;">
  <div class="col-md-8 col-md-offset-2">

    <div class="col-md-4">
      <div class="panel panel-default" style="width:100%;">

        <div class="panel-body" >
          <div class="text-center">
            <h2>
              Educadores
              <hr style="border-top: 1px solid black;">
            </h2>
          </div>

          <div class="hifen text-justify">
            <h3>
              Saiba o que está acontecendo em outras salas de aula e mantenha o registro do seu cotidiano com o aluno para que seus familiares possam acompanhar seu progresso.
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="panel panel-default" style="width:100%;">

        <div class="panel-body">
          <div class="text-center">
            <h2>
              Profissionais
              <hr style="border-top: 1px solid black;">
            </h2>
          </div>

          <div class="hifen text-justify">
            <h3>
              Interaja com profissionais da Educação e forneça sugestões de como aumentar a qualidade de vida dos seus pacientes no ambiente escolar.
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="panel panel-default" style="width:100%;">
        <div class="panel-body">
          <div class="text-center">
            <h2>
              Familiares
              <hr style="border-top: 1px solid black;">
            </h2>
          </div>

          <div class="text-justify">
            <h3>
              Verifique quais atividades estão sendo realizadas com o seu familiar, quais objetivos estão sendo alcançados e fique à vontade para tirar dúvidas no fórum.
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
