@extends('layouts.principal')
@section('title','Cadastrar aluno')
@section('path','Início')

@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a> > Novo Aluno
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            <strong>
              Novo Aluno
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">
          <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route("aluno.criar") }}" enctype="multipart/form-data">

              {{ csrf_field() }}

              @if(\Session::has('cpf'))

                <h3>
                  <strong>
                    Instituição
                  </strong>
                </h3>

                <hr style="border-top: 1px solid black;">

                <div class="form-group{{ $errors->has('instituicoes') ? ' has-error' : '' }}">
                  <label for="instituicoes" class="col-md-12 control-label">Instituição(ões) <font color="red">*</font> </label>

                  <div class="col-md-12">
                    <select class="form-control js-example-basic-multiple" name="instituicoes[]" multiple="multiple" autofocus>
                      @foreach ($instituicoes as $instituicao)
                        @php($selected = false)
                        @if(old("instituicoes.0") != null )

                          @for ($i=0; $i < count($instituicoes) ; $i++) {
                            @if(old("instituicoes.".$i) == $instituicao->id)
                              @php($selected = true)
                              @break
                            @endif
                          @endfor

                          @if($selected)
                            <option value="{{$instituicao->id}}" selected> {{$instituicao->nome}}, {{ $instituicao->endereco->logradouro }}, {{ $instituicao->endereco->cidade }} - {{ $instituicao->endereco->estado }} </option>
                          @else
                            <option value="{{$instituicao->id}}">{{$instituicao->nome}}, {{ $instituicao->endereco->logradouro }}, {{ $instituicao->endereco->cidade }} - {{ $instituicao->endereco->estado }} </option>
                          @endif

                        @else
                          <option value="{{$instituicao->id}}">{{$instituicao->nome}}, {{ $instituicao->endereco->logradouro }}, {{ $instituicao->endereco->cidade }} - {{ $instituicao->endereco->estado }} </option>
                        @endif
                      @endforeach
                    </select>

                    @if ($errors->has("instituicoes"))
                      <span class="help-block">
                        <strong>{{ $errors->first("instituicoes") }}</strong>
                      </span>
                    @endif

                  </div>
                </div>

                <h3>
                  <strong>
                    Identificação
                  </strong>
                </h3>

                <hr style="border-top: 1px solid black;">
                <input type="hidden" name="cpf" value="{!! \Session::get('cpf') !!}">

                <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                  <label for="cpf" class="col-md-12 control-label"> CPF <font color="red">*</font></label>

                  <div class="col-md-12">
                    <input id="cpf" type="text" class="form-control" name="cpf" readonly value="{!! \Session::get('cpf') !!}">

                    @if ($errors->has('cpf'))
                      <span class="help-block">
                        <strong>{{ $errors->first('cpf') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                  <label for="nome" class="col-md-12 control-label"> Nome <font color="red">*</font></label>

                  <div class="col-md-12">
                    <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}">

                    @if ($errors->has('nome'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nome') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group{{ $errors->has('imagem') ? ' has-error' : '' }}">
                  <label for="imagem" class="col-md-12 control-label" >Foto de perfil</label>

                  <div class="col-md-12">
                    <input id="imagem" type="file" class="filestyle" name="imagem" data-placeholder="Nenhum arquivo" data-text="Selecionar" data-btnClass="btn btn-primary">

                    @if ($errors->has('imagem'))
                      <span class="help-block">
                        <strong>{{ $errors->first('imagem') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="row" style="padding:0px">
                  <div class="col-md-12" style="padding:0px">
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('data_nascimento') ? ' has-error' : '' }}">
                        <label for="data_nascimento" class="col-md-12 control-label">Data de Nascimento <font color="red">*</font> </label>

                        <div class="col-md-12">
                          <input id="data_nascimento" type="date" class="form-control" name="data_nascimento" value="{{ old('data_nascimento') }}">

                          @if ($errors->has('data_nascimento'))
                            <span class="help-block">
                              <strong>{{ $errors->first('data_nascimento') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}">

                        <label for="sexo" class="col-md-12 control-label">Sexo <font color="red">*</font> </label>

                        <div class="col-md-12">
                          @if(old('sexo') == "M")
                            <input type="radio" id="sexo1" name="sexo" value="M" checked="checked">
                          @else
                            <input type="radio" id="sexo1" name="sexo" value="M">
                          @endif

                          <label class="custom-control-label" for="sexo1">Masculino</label>

                          @if(old('sexo') == "F")
                            <input type="radio" id="sexo2" name="sexo" value="F" checked="checked">
                          @else
                            <input type="radio" id="sexo2" name="sexo" value="F">
                          @endif

                          <label class="custom-control-label" for="sexo2">Feminino</label>

                          @if ($errors->has('sexo'))
                            <span class="help-block">
                              <strong>{{ $errors->first('sexo') }}</strong>
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

                <h3>
                  <strong>
                    Dados Médicos
                  </strong>
                </h3>

                <hr style="border-top: 1px solid black;">

                <div class="form-group{{ $errors->has('cid') ? ' has-error' : '' }}">
                  <label for="cid" class="col-md-12 control-label">CID</label>

                  <div class="col-md-12">
                    <input id="cid" type="text" class="form-control" placeholder="X000" name="cid" value="{{ old('cid') }}">

                    @if ($errors->has('cid'))
                      <span class="help-block">
                        <strong>{{ $errors->first('cid') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group{{ $errors->has('descricaoCid') ? ' has-error' : '' }}">
                  <label for="descricaoCid" class="col-md-12 control-label">Descrição do CID</label>

                  <div class="col-md-12">
                    <input style="margin-bottom:15px;" id="descricaoCid" type="text" class="form-control" name="descricaoCid" value="{{ old('descricaoCid') }}">

                    @if ($errors->has('descricaoCid'))
                      <span class="help-block">
                        <strong>{{ $errors->first('descricaoCid') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <h3>
                  <strong>
                    Outras Observacões
                  </strong>
                </h3>

                <hr style="border-top: 1px solid black;">

                <div class="form-group{{ $errors->has('observacao') ? ' has-error' : '' }}">
                  <label for="observacao" class="col-md-12 control-label">Observações</label>

                  <div class="col-md-12">
                    <textarea name="observacao" style="width:75%;" id="summer" type="text" class="form-control summernote">
                      {{old('observacao')}}
                    </textarea>

                    <br>

                    @if ($errors->has('observacao'))
                      <span class="help-block">
                        <strong>{{ $errors->first('observacao') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <h3>
                  <strong>
                    Perfil do Cadastrante
                  </strong>
                </h3>

                <hr style="border-top: 1px solid black;">

                <div class="form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
                  <label for="perfil" class="col-md-12 control-label">Perfil</label>

                  <div class="col-md-12">
                    <select style="margin-bottom:15px;" id="perfil" class="form-control" name="perfil" onchange="showResponsavel(this)">
                      @if (old('perfil') == null)
                        <option id="perfil" selected disabled hidden>Escolha seu perfil</option>
                      @endif

                      @foreach($perfis as $perfil)
                        @if(old('perfil') == $perfil[0])
                          <option value={{$perfil[0]}} selected>{{$perfil[1]}}</option>
                        @else
                          <option value={{$perfil[0]}}>{{$perfil[1]}}</option>
                        @endif
                      @endforeach
                    </select>

                    @if ($errors->has('perfil'))
                      <span class="help-block">
                        <strong>{{ $errors->first('perfil') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                @if(old('perfil') == "2")
                  <div id="div-responsavel" style="display: block;">
                @else
                  <div id="div-responsavel" style="display: none;">
                @endif

                <h3>
                  <strong>
                    Responsável
                  </strong>
                </h3>

                <hr style="border-top: 1px solid black;">

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="username" class="col-md-12 control-label">Nome de Usuário <font color="red">*</font> </label>

                  <div class="col-md-12">
                    <input id="username" autocomplete="off" name="username" type="text" class="form-control" value="{{old('username')}}">

                    @if ($errors->has('username'))
                      <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group{{ $errors->has('cadastrado') ? ' has-error' : '' }}">
                  <label for="cadastrado" class="col-md-12 control-label">Usuário já cadastrado?</label>

                  <div class="col-md-12">
                    @if(old('cadastrado') == "true")
                      <input type="radio" name="cadastrado" id="sim" value="true" checked>
                    @else
                      <input type="radio" name="cadastrado" id="sim" value="true">
                    @endif

                    <label for="sim">Sim</label>

                    @if(old('cadastrado') == "false" || old('cadastrado') == null)
                      <input type="radio" name="cadastrado" id="nao" value="false" checked>
                    @else
                      <input type="radio" name="cadastrado" id="nao" value="false">
                    @endif

                    <label for="nao">Não</label>

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
              @else
                <div class="alert alert-info">
                  <center>
                    <h3>
                      Informe o CPF do aluno nesta página primeiro:
                      <a class="btn btn-primary" style="width:160px" href="{{ route("aluno.buscar") }}">Novo Aluno</a>
                    </h3>
                  </center>
                </div>
              @endif
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

<script type="text/javascript">
  $('#summer').summernote({
    lang: 'pt-BR',
    tabsize: 2,
    height: 100
  });
</script>

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

<script src="{{ asset('js/bootstrap-filestyle.min.js')}}"> </script>

@endsection
