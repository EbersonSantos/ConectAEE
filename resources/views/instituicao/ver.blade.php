@extends('layouts.principal')
@section('title','Ver instituição')
@section('navbar')
<a href="{{route('instituicao.listar')}}">Instituições</a>
> Ver
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h2>
            <strong>
              {{$instituicao->nome}}
            </strong>

            <hr style="border-top: 1px solid black;">
          </h2>
        </div>

        <div class="panel-body">
          <div class="col-md-8 col-md-offset-2">
            <h3>
              <strong>
                Dados Instituicionais:
              </strong>
            </h3>

            <hr style="border-top: 1px solid black;">

            <strong>Nome: </strong>{{$instituicao->nome}}
            <br>
            <strong>Telefone: </strong>{{$instituicao->telefone}}
            <br>
            <strong>Email: </strong>{{$instituicao->email}}

            <h3>
              <strong>
                Endereço:
              </strong>
            </h3>

            <hr style="border-top: 1px solid black;">

            <div class="col-md-6" style="padding:0px">
              <strong>Logradouro: </strong>{{$instituicao->endereco->logradouro}}
              <br>
              <strong>Bairro: </strong>{{$instituicao->endereco->bairro}}
              <br>
              <strong>Cidade: </strong>{{$instituicao->endereco->cidade}}
              <br>
              <strong>Estado: </strong>{{$instituicao->endereco->estado}}
            </div>

            <div class="col-md-6" style="padding: 0px">
              <strong>Número: </strong>{{$instituicao->endereco->numero}}
            </div>

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
