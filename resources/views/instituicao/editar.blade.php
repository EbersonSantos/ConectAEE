@extends('layouts.principal')
@section('title','Editar instituição')
@section('path','Início')

@section('navbar')
<a href="{{route('instituicao.listar')}}">Instituições</a>
> Editar: <strong>{{$instituicao->nome}}</strong>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Editar Instituição
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">
          <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route("instituicao.atualizar") }}">
              {{ csrf_field() }}

              <input type="hidden" name="id_instituicao" value="{{ $instituicao->id }}">
              <input type="hidden" name="id_endereco" value="{{ $endereco->id }}">

              <h3>
                <strong>
                  Dados Instituicionais:
                </strong>
              </h3>

              <hr style="border-top: 1px solid black;">

              <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                <label for="nome" class="col-md-12 control-label"> Nome <font color="red">*</font>
                </label>

                <div class="col-md-12">

                  @if(old('nome',NULL) != NULL)
                    <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" autofocus>
                  @else
                    <input id="nome" type="text" class="form-control" name="nome" value="{{ $instituicao->nome }}" autofocus>
                  @endif

                  @if ($errors->has('nome'))
                    <span class="help-block">
                      <strong>{{ $errors->first('nome') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row" style="padding:0px">
                <div class="col-md-12" style="padding:0px">
                  <div class="col-md-6">
                    <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                      <label for="telefone" class="col-md-12 control-label">Telefone <font color="red">*</font> </label>

                      <div class="col-md-12">

                        @if(old('telefone',NULL) != NULL)
                          <input id="telefone" type="digit" class="form-control" name="telefone" minlength="10" placeholder="DDD+Telefone" maxlength="11" value="{{ old('telefone') }}">
                        @else
                          <input id="telefone" type="digit" class="form-control" name="telefone" minlength="10" placeholder="DDD+Telefone" maxlength="11" value="{{ $instituicao->telefone }}">
                        @endif

                        @if ($errors->has('telefone'))
                          <span class="help-block">
                            <strong>{{ $errors->first('telefone') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="col-md-12 control-label">E-Mail</label>

                      <div class="col-md-12">

                        @if(old('email',NULL) != NULL)
                          <input id="email" class="form-control" name="email" value="{{ old('email') }}">
                        @else
                          <input id="email" class="form-control" name="email" value="{{ $instituicao->email }}">
                        @endif

                        @if ($errors->has('email'))
                          <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <h3>
                <strong>
                  Endereço
                </strong>
              </h3>

              <hr style="border-top: 1px solid black;">

              <div class="row" style="padding:0px">
                <div class="col-md-12" style="padding:0px">
                  <div class="col-md-8">
                    <div class="form-group{{ $errors->has('logradouro') ? ' has-error' : '' }}">
                      <label for="logradouro" class="col-md-12 control-label">Logradouro <font color="red">*</font></label>

                      <div class="col-md-12">

                        @if(old('logradouro',NULL) != NULL)
                          <input id="logradouro" type="text" class="form-control" name="logradouro" value="{{ old('logradouro') }}">
                        @else
                          <input id="logradouro" type="text" class="form-control" name="logradouro" value="{{ $endereco->logradouro }}">
                        @endif

                        @if ($errors->has('logradouro'))
                          <span class="help-block">
                            <strong>{{ $errors->first('logradouro') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                      <label for="numero" class="col-md-12 control-label">Número <font color="red">*</font> </label>

                      <div class="col-md-12">

                        @if(old('numero',NULL) != NULL)
                          <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}">
                        @else
                          <input id="numero" type="text" class="form-control" name="numero" value="{{ $endereco->numero }}">
                        @endif

                        @if ($errors->has('numero'))
                          <span class="help-block">
                            <strong>{{ $errors->first('numero') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row" style="padding:0px">
                <div class="col-md-12" style="padding:0px">
                  <div class="col-md-4">
                    <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                      <label for="bairro" class="col-md-12 control-label">Bairro <font color="red">*</font></label>

                      <div class="col-md-12">

                        @if(old('bairro',NULL) != NULL)
                          <input id="bairro" type="text" class="form-control" name="bairro" value="{{ old('bairro') }}">
                        @else
                          <input id="bairro" type="text" class="form-control" name="bairro" value="{{ $endereco->bairro }}">
                        @endif

                        @if ($errors->has('bairro'))
                          <span class="help-block">
                            <strong>{{ $errors->first('bairro') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                      <label for="estado" class="col-md-12 control-label">Estado <font color="red">*</font> </label>

                      <div class="col-md-12">
                        <select id="estado" class="form-control" name="estado" data-target="#cidade">
                          <option value="">Estado</option>
                        </select>

                        @if ($errors->has('estado'))
                          <span class="help-block">
                            <strong>{{ $errors->first('estado') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                      <label for="cidade" class="col-md-12 control-label">Cidade <font color="red">*</font> </label>

                      <div class="col-md-12">

                        <select id="cidade" class="form-control" name="cidade">
                          <option value=""> Cidade </option>
                        </select>

                        @if ($errors->has('cidade'))
                          <span class="help-block">
                            <strong>{{ $errors->first('cidade') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
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

<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.js-example-basic-multiple').select2();
});
</script>

<script>
var estados = [];

function loadEstados(element) {
  if (estados.length > 0) {
    putEstados(element);
    $(element).removeAttr('disabled');
  } else {
    $.ajax({
      url: 'https://api.myjson.com/bins/enzld',
      method: 'get',
      dataType: 'json',
      beforeSend: function() {
        $(element).html('<option>Carregando...</option>');
      }
    }).done(function(response) {
      estados = response.estados;
      putEstados(element);
      $(element).removeAttr('disabled');
    });
  }
}

function putEstados(element) {
  var oldEstado = "{{old('estado')}}";
  var instEstado = "{{$endereco->estado}}";

  var label = $(element).data('label');
  label = label ? label : 'Estado';

  var estadoAtual;

  var options = '<option value="">' + label + '</option>';
  for (var i in estados) {
    var estado = estados[i];

    if((estado.sigla == instEstado && oldEstado == "") || estado.sigla == oldEstado){
      estadoAtual = estado.sigla;
      options += '<option selected value="' + estado.sigla + '">' + estado.nome + '</option>';
    }else{
      options += '<option value="' + estado.sigla + '">' + estado.nome + '</option>';
    }
  }

  var target = $(element).data('target');

  if (target) {
    loadCidades(target, estadoAtual);
  }

  $(element).html(options);
}

function loadCidades(element, estado_sigla) {
  if (estados.length > 0) {
    putCidades(element, estado_sigla);
    $(element).removeAttr('disabled');
  } else {
    $.ajax({
      url: theme_url + '/assets/json/estados.json',
      method: 'get',
      dataType: 'json',
      beforeSend: function() {
        $(element).html('<option>Carregando...</option>');
      }
    }).done(function(response) {
      estados = response.estados;
      putCidades(element, estado_sigla);
      $(element).removeAttr('disabled');
    });
  }
}

function putCidades(element, estado_sigla) {
  var label = $(element).data('label');
  label = label ? label : 'Cidade';

  var oldCidade = "{{old('cidade')}}";
  var instCidade = "{{$endereco->cidade}}"

  var options = '<option value="">' + label + '</option>';
  for (var i in estados) {
    var estado = estados[i];
    if (estado.sigla != estado_sigla)
    continue;
    for (var j in estado.cidades) {
      var cidade = estado.cidades[j];

      if((cidade == instCidade && oldCidade == "") || cidade == oldCidade){
        options += '<option selected value="' + cidade + '">' + cidade + '</option>';
      }else {
        options += '<option value="' + cidade + '">' + cidade + '</option>';
      }
    }
  }
  $(element).html(options);
}

document.addEventListener('DOMContentLoaded', function() {
  loadEstados('#estado');

  $(document).on('change', '#estado', function(e) {
    var target = $(this).data('target');
    if (target) {
      loadCidades(target, $(this).val());
    }
  });
}, false);

</script>
@endsection
