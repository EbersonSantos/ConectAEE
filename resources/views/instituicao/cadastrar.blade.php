@extends('layouts.principal')
@section('title','Cadastrar instituição')
@section('path','Início')

@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a> > Nova Instituição
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Nova Instituição
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">


          <div class="col-md-8 col-md-offset-2">

            @if (\Session::has('info'))
              <div class="alert alert-info">
                <strong>
                  {!! \Session::get('info') !!}
                </strong>
              </div>
            @endif

            <form method="POST" action="{{ route("instituicao.criar") }}">
              {{ csrf_field() }}

              <input type="hidden" name="rota" value="{{URL::previous()}}">

              <h3>
                <strong>
                  Dados Instituicionais
                </strong>
              </h3>

              <hr style="border-top: 1px solid black;">

              <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                <label for="nome" class="col-md-12 control-label"> Nome <font color="red">*</font> </label>

                <div class="col-md-12">
                  <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" autofocus>

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
                        <input  type="digit" class="form-control" name="telefone" id="telefone" minlength="10" placeholder="DDD+Telefone" maxlength="11" value="{{ old('telefone') }}">

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
                        <input id="email" class="form-control" name="email" value="{{ old('email') }}">

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

                        <input id="logradouro" type="text" class="form-control" name="logradouro" value="{{ old('logradouro') }}">

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

                    <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}">

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

                        <input id="bairro" type="text" class="form-control" name="bairro" value="{{ old('bairro') }}">

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

    var label = $(element).data('label');
    label = label ? label : 'Estado';

    var options = '<option value="">' + label + '</option>';
    for (var i in estados) {
      var estado = estados[i];

      if(estado.sigla == oldEstado){
        options += '<option selected value="' + estado.sigla + '">' + estado.nome + '</option>';
      }else{
        options += '<option value="' + estado.sigla + '">' + estado.nome + '</option>';
      }
    }

    if(oldEstado != ""){
      var target = $(element).data('target');

      if (target) {
        loadCidades(target, oldEstado);
      }
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
      }).done(function(response) {
        estados = response.estados;
        putCidades(element, estado_sigla);
        $(element).removeAttr('disabled');
      });
      document.write(estados.length);
    }
  }

  function putCidades(element, estado_sigla) {
    var label = $(element).data('label');
    label = label ? label : 'Cidade';

    var oldCidade = "{{old('cidade')}}";

    var options = '<option value="">' + label + '</option>';
    for (var i in estados) {
      var estado = estados[i];
      if (estado.sigla != estado_sigla)
      continue;
      for (var j in estado.cidades) {
        var cidade = estado.cidades[j];

        if (cidade == oldCidade) {
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
