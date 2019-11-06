@extends('layouts.principal')
@section('title','Cadastrar atividade')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href="{{route('objetivo.listar',$aluno->id)}}">Objetivos</a>
> <a href="{{route('objetivo.gerenciar',[$objetivo->id])}}"><strong>{{$objetivo->titulo}}</strong></a>
> Nova Atividade
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Nova Atividade
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">
          <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route("atividades.criar") }}">
              {{ csrf_field() }}

              <input type="hidden" name="id_aluno" value="{{ $aluno->id }}">
              <input type="hidden" name="id_objetivo" value="{{ $objetivo->id }}">

              <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label for="titulo" class="col-md-12 control-label">Título <font color="red">*</font> </label>

                <div class="col-md-12">
                  <input id="titulo" type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" autofocus>

                  @if ($errors->has('titulo'))
                    <span class="help-block">
                      <strong>{{ $errors->first('titulo') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                <label for="descricao" class="col-md-12 control-label">Descrição</label>

                <div class="col-md-12">
                  <textarea id="descricao" rows = "5" cols = "50" class="form-control" name="descricao">{{ old('descricao') }}</textarea>

                  @if ($errors->has('descricao'))
                    <span class="help-block">
                      <strong>{{ $errors->first('descricao') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                <label for="status" class="col-md-12 control-label">Status <font color="red">*</font> </label>

                <div class="col-md-12">
                  <select id="status" class="form-control" name="status">

                    @if (old('status') == null)
                      <option value="" selected disabled hidden>Escolha o status</option>
                    @endif

                    @foreach($statuses as $key => $status)
                      @if(old('status') ==  $status)
                        <option value={{$key}} selected>{{$status}}</option>
                      @else
                        <option value={{$key}}>{{$status}}</option>
                      @endif
                    @endforeach
                  </select>

                  @if ($errors->has('status'))
                    <span class="help-block">
                      <strong>{{ $errors->first('status') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('prioridade') ? ' has-error' : '' }}">
                <label for="prioridade" class="col-md-12 control-label">Prioridade <font color="red">*</font> </label>

                <div class="col-md-12">
                  <select id="prioridade" class="form-control" name="prioridade">
                    @if (old('prioridade') == null)
                      <option value="" selected disabled hidden>Escolha a prioridade</option>
                    @endif

                    @foreach($prioridades as $prioridade)
                      @if(old('prioridade') == $prioridade)
                        <option value={{$prioridade}} selected>{{$prioridade}}</option>
                      @else
                        <option value={{$prioridade}}>{{$prioridade}}</option>
                      @endif
                    @endforeach
                  </select>

                  @if ($errors->has('prioridade'))
                    <span class="help-block">
                      <strong>{{ $errors->first('prioridade') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="row col-md-12 text-center">
                  <br>
                  <button type="submit" class="btn btn-primary">
                    Cadastrar
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
