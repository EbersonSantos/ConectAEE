@extends('layouts.principal')
@section('title','Cadastrar objetivo')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href="{{route('objetivo.listar',$aluno->id)}}">Objetivos</a>
> Novo
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Novo Objetivo
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">
          <div class="col-md-8 col-md-offset-2">

            <form method="POST" action="{{ route("objetivo.criar") }}">
              {{ csrf_field() }}

              <input id="id_aluno" type="hidden" class="form-control" name="id_aluno" value="{{ $aluno->id }}">

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
                <label for="descricao" class="col-md-12 control-label">Descrição <font color="red">*</font> </label>

                <div class="col-md-12">
                  <textarea id="descricao" rows = "8" cols = "50" class="form-control" name="descricao">{{ old('descricao') }}</textarea>

                  @if ($errors->has('descricao'))
                    <span class="help-block">
                      <strong>{{ $errors->first('descricao') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                <label for="tipo" class="col-md-12 control-label">Tipo <font color="red">*</font></label>

                <div class="col-md-12">
                  <select id="tipo" class="form-control" name="tipo">

                    @if (old('tipo') == null)
                      <option value="" selected disabled hidden>Escolha o tipo</option>
                    @endif

                    @foreach($tipos as $tipo)
                      @if(old('tipo') == $tipo->id)
                        <option value={{$tipo->id}} selected>{{$tipo->tipo}}</option>
                      @else
                        <option value={{$tipo->id}}>{{$tipo->tipo}}</option>
                      @endif
                    @endforeach
                  </select>

                  @if ($errors->has('tipo'))
                    <span class="help-block">
                      <strong>{{ $errors->first('tipo') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('prioridade') ? ' has-error' : '' }}">
                <label for="prioridade" class="col-md-12 control-label">Prioridade <font color="red">*</font></label>

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
