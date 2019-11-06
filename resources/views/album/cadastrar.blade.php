@extends('layouts.principal')
@section('title','Cadastrar álbum')
@section('path','Início')

@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href={{route("album.listar", ["id_aluno"=>$aluno->id]) }}>Álbuns</a>
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
              Novo Álbum
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">
          <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route("album.criar") }}" enctype="multipart/form-data">
              {{ csrf_field() }}

              <input id="id_aluno" type="hidden" class="form-control" name="id_aluno" value="{{ $aluno->id }}">

              <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                <label for="nome" class="col-md-12 control-label"> Nome <font color="red">*</font>
                </label>

                <div class="col-md-12">
                  <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" autofocus>

                  @if ($errors->has('nome'))
                  <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                <label for="descricao" class="col-md-12 control-label">Descrição</label>

                <div class="col-md-12">
                  <textarea id="descricao" rows = "5" cols = "50" class="form-control" name="descricao" >{{old('descricao')}}</textarea>

                  @if ($errors->has('descricao'))
                  <span class="help-block">
                    <strong>{{ $errors->first('descricao') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('imagens.*') || $errors->has('imagens')? ' has-error' : '' }}">
                <label for="imagens" class="col-md-12 control-label" >
                  Fotos <font color="red">*</font>
                </label>

                <div class="col-md-12">

                  <input id="imagens" type="file" multiple class="filestyle" name="imagens[]" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn btn-primary">

                  @if ($errors->has('imagens') || $errors->has('imagens.*'))
                    <span class="help-block">
                      <strong>{{ $errors->first('imagens') }}</strong>
                      <strong>{{ $errors->first('imagens.*') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <!-- <i class="material-icons tiny" style="font-size:100px">add_box</i> -->

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

<script src="{{ asset('js/bootstrap-filestyle.min.js')}}"> </script>

@endsection
