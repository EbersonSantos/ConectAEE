@extends('layouts.principal')
@section('title','Listar objetivos')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> Objetivos
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <div class="row">
            <div class="col-md-8">
              <div style="width: 100%; margin-left: 0%;" class="row">
                <div style="width: 50%; float: left; margin-left:-20px;" class="col-md-6">
                  <h2>
                    <strong>
                      Objetivos para {{ explode(" ", $aluno->nome)[0]}}
                    </strong>
                  </h2>
                </div>
                <div style="width:50%; float:right; margin-right:-15px;" class="col-md-6">
                  @if(App\Gerenciar::where('user_id','=',\Auth::user()->id)->where('aluno_id','=',$aluno->id)->first()->perfil_id != 1)
                    <a class="btn btn-primary" style="float:right; margin-top:20px;" href="{{ route("objetivo.cadastrar" , ['id_aluno'=>$aluno->id])}}">
                      Novo Objetivo
                    </a>
                  @endif
                </div>
              </div>
            </div>

            <div class="row col-md-4">
              @if(count($objetivosGroupByUser) != 0 || ($termo != "" && count($objetivosGroupByUser) == 0))
                <form class="form-horizontal" method="GET" action="{{ route("objetivo.buscar", ['id-aluno' => $aluno->id]) }}">

                  <div id="divBusca" style="margin-top:20px;">

                  <i class="material-icons">search</i>

                  @if ($termo == null)
                    <input id="termo" type="text" autocomplete="off" name="termo" autofocus placeholder="Título ou descrição">
                  @else
                    <input id="termo" type="text" autocomplete="off" name="termo" autofocus placeholder="Título ou descrição" value="{{$termo}}">
                  @endif

                  <button id="btnBusca" type="submit">
                    Buscar
                  </button>
                  </div>
                </form>
              @endif
            </div>

          </div>

          <hr style="border-top: 1px solid black;">

        </div>

        <div class="panel-body">

          @if (\Session::has('success'))
            <br>
            <div class="alert alert-success">
              <strong>Sucesso!</strong>
              {!! \Session::get('success') !!}
            </div>
          @endif

          <div id="tabela_objetivos" class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th><strong>Usuário</strong></th>
                  <th><strong>Perfil</strong></th>
                  <th><strong>Objetivos</strong></th>
                </tr>
              </thead>
              <tbody>
                @php($user = 0)

                @foreach ($objetivosGroupByUser as $user_id => $objetivos)

                  <?php
                    $perfil = "";

                    $gerenciar = App\Gerenciar::where('user_id','=',$user_id)->where('aluno_id','=',$aluno->id)->first();

                    if($gerenciar->perfil->especializacao == NULL){
                      $perfil = $gerenciar->perfil->nome;
                    }else{
                      $perfil = $gerenciar->perfil->especializacao;
                    }
                  ?>

                  <tr>
                    <td style="vertical-align:middle;" data-title="Usuario">{{ $objetivos[0]->user->name}}</td>
                    <td style="vertical-align:middle" data-title="Perfil">{{ $perfil }}</td>

                    @php($temp = 0)

                    <td data-title="Objetivos" class="row col-md-12" style="margin-left:0px">
                      @foreach ($objetivos as $objetivo)
                        <a href="{{ route("objetivo.gerenciar", ['id_objetivo'=>$objetivo->id]) }}">
                          <!-- $objetivo->cor->hexadecimal -->
                          <div class="card cartao" style="width: 16rem; height: 16rem; background-color:#12583C">
                            <div class="card-body" style="height:76%; margin-left: 5%; margin-right: 5%; display: -webkit-flex; display: flex;-webkit-align-items: center;align-items: center;-webkit-justify-content: center;justify-content: center;">
                              <div class="hifen text-center" align="justify">
                                <font size="3" color="white">
                                  <strong> {{ ucfirst($objetivo->titulo) }} </strong>
                                  <br>
                                </font>
                              </div>
                            </div>
                            <div class="card-footer text-center">
                              <font size="3" color="white">
                                <strong> {{ $objetivo->data }} </strong>
                                <br>
                              </font>
                            </div>
                          </div>
                        </a>
                        @php($temp += 1)
                      @endforeach
                    </td>

                    @php($user += 1)

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          @if($termo != "" && count($objetivosGroupByUser) == 0)
            <div class="alert alert-danger">
              <strong> Nenhum resultado encontrado!</strong>
            </div>
          @elseif(count($objetivosGroupByUser) == 0)
            <div class="alert alert-info">
              <strong> Nenhum objetivo cadastrado.</strong>
            </div>
          @endif
        </div>

        <!-- <div class="panel-footer" style="background-color:white">
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
