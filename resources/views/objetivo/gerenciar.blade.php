@extends('layouts.principal')
@section('title','Gerenciar objetivo')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href="{{route('objetivo.listar',$aluno->id)}}">Objetivos</a>
> <strong>{{$objetivo->titulo}}</strong>
@endsection

@section('content')
<div class="container">
  <div class="row">

    <div class="panel panel-default">

      <div class="panel-heading">
        <div class="row">

          <div class="col-md-6">
            <h2>
              <strong>
                Gerenciar Objetivo
              </strong>
            </h2>
          </div>

          <div class="col-md-6 text-right" style="margin-top:20px">
            @if($objetivo->user->id == \Auth::user()->id && $objetivo->concluido == false)
              <a class="btn btn-primary" href={{ route("objetivo.editar" , ['id_objetivo' => $objetivo->id]) }}>
                Editar
              </a>
              <a class="btn btn-primary" href={{ route("objetivo.concluir" , ['id_objetivo' => $objetivo->id]) }}>
                Finalizar
              </a>
              <a class="btn btn-danger" onclick="return confirm('\Confirmar exclusão do objetivo {{$objetivo->titulo}}?')" href={{ route("objetivo.excluir" , ['id_objetivo' => $objetivo->id]) }}>
                Excluir
              </a>
            @elseif($objetivo->user->id == \Auth::user()->id && $objetivo->concluido == true)
              <a class="btn btn-primary" href={{ route("objetivo.desconcluir" , ['id_objetivo' => $objetivo->id]) }}>
                Reabrir
              </a>
            @endif
          </div>

        </div>

        <hr style="border-top: 1px solid black;">
      </div>

      <div class="panel-body">
        @if (\Session::has('success'))
          <div class="alert alert-success">
            <strong>Sucesso!</strong>
            {!! \Session::get('success') !!}
          </div>
        @endif

        <div class="row col-md-12">
          <div class="row col-md-12" style="margin-left:0px; margin-top:-20px;">
            <h3>
              <strong>Objetivo: </strong>{{$objetivo->titulo}}
            </h3>
            <hr style="border-top: 1px solid black;">
          </div>

          <div class="col-md-6">
            <strong>Autor: </strong>{{$objetivo->user->name}}
            <br>
            <strong>Prioridade: </strong>{{$objetivo->prioridade}}
            <br>
            <strong>Tipo: </strong>{{$objetivo->tipoObjetivo->tipo}}
            <br>
            <strong>Concluído: </strong>
            <?php
              echo $objetivo->concluido ? "Sim" : "Não";
            ?>
            <br>

          </div>

          <div class="col-md-6">
            <strong>Histórico de Status: </strong> <br>
            <ul>
              @foreach ($objetivo->statusObjetivo as $statusObjetivo)
                <li>
                  {{ $statusObjetivo->status->status }} - {{ $statusObjetivo->data}} <br>
                </li>
              @endforeach
            </ul>

            <strong>Status atual:</strong>

            <form method="POST" action="{{ route("objetivo.status.atualizar") }}">
              {{ csrf_field() }}

              <input id="id_aluno" type="hidden" class="form-control" name="id_aluno" value="{{ $aluno->id }}">
              <input id="id_objetivo" type="hidden" class="form-control" name="id_objetivo" value="{{ $objetivo->id }}">

              <div class="col-md-12">

                <div class="col-md-6 text-center">
                  <select id="status" class="form-control" name="status" style="margin-bottom:10px">
                    @foreach($statusesObjetivo as $status)
                      @if($statusObjetivo->status == $status)
                        <option value={{$status->id}} selected>{{$status->status}}</option>
                      @else
                        <option value={{$status->id}}>{{$status->status}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6 text-center">
                  <button type="submit" class="btn btn-primary">
                    Atualizar
                  </button>
                </div>
              </div>
            </form>
          </div>

          <div class="row col-md-12" style="margin-left:0px;" align="justify">
            <br>
            <strong>Descrição: </strong>{{$objetivo->descricao}}
          </div>
        </div>

        <div class="row col-md-12">
          <div id="atividades">

            <div class="panel-heading">
              <div class="row">

                <div class="col-md-6">
                  <h3>
                    <strong>Atividades</strong>
                  </h3>
                </div>

                <div class="col-md-6 text-right" style="margin-top:20px">
                  @if(App\Gerenciar::where('user_id','=',\Auth::user()->id)->where('aluno_id','=',$aluno->id)->first()->perfil_id != 1 && $objetivo->user->id == \Auth::user()->id)
                    <a class="btn btn-primary" href="{{ route("atividades.cadastrar" , ['id_objetivo' => $objetivo->id])}}">
                      Nova Atividade
                    </a>
                  @endif
                </div>
              </div>

              <hr style="border-top: 1px solid black;">
            </div>

            <div class="panel-body">

              @if (\Session::has('atividade'))
                <div class="alert alert-success">
                  <strong>Sucesso!</strong>
                  {!! \Session::get('atividade') !!}
                </div>
              @endif

              @if(count($atividades) != 0)
                <div id="tabela" class="table-responsive">
                  <table class="table table-striped" id="table1">
                    <thead>
                      <tr>
                        <th style="width:20%;cursor:pointer;" onclick="sortTable(0, 'table1')">
                          STATUS <img class="on-contrast-force-white" src="{{asset('images/sort.png')}}" style="height:15px">
                        </th>
                        <th style="width:30%;cursor:pointer;" onclick="sortTable(1, 'table1')">
                          TÍTULO <img class="on-contrast-force-white" src="{{asset('images/sort.png')}}" style="height:15px">
                        </th>
                        <th style="width:25%;cursor:pointer;" onclick="sortTable(2, 'table1')">
                          DATA <img class="on-contrast-force-white" src="{{asset('images/sort.png')}}" style="height:15px">
                        </th>
                        <th style="width:25%">Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($atividades as $atividade)
                        <tr>
                          <td data-title="Status" class="output">
                            @php($cor = \App\Http\Controllers\AtividadeController::corStatus($atividade->status))
                            <span style="background:{{$cor}}"></span>
                            {{$atividade->status}}
                          </td>
                          <td data-title="Atividades">
                            {{ $atividade->titulo }}
                          </td>
                          <td data-title="Data">{{ $atividade->data }}</td>
                          <td data-title="Ações">
                            @if($atividade->objetivo->user->id == \Auth::user()->id)
                              <a class="btn btn-primary" data-toggle="modal" data-target="#modalAtividade{{$atividade->id}}">Gerenciar</a>
                            @else
                              <a class="btn btn-primary" data-toggle="modal" data-target="#modalAtividade{{$atividade->id}}">Ver</a>
                            @endif
                          </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalAtividade{{$atividade->id}}" role="dialog">
                          <div class="modal-dialog modal-lg" style="background-color:white">

                            <!-- Modal content-->
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                <h2>
                                  <strong>
                                    {{$atividade->titulo}}
                                  </strong>
                                </h2>

                                <hr style="border-top: 1px solid black;">
                              </div>

                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <strong>Título: </strong>{{$atividade->titulo}}
                                    <br><br>
                                    <strong>Prioridade: </strong>{{$atividade->prioridade}}
                                    <br><br>
                                    <strong>Status: </strong>{{$atividade->status}}
                                    <br><br>
                                    <strong>Data: </strong> {{$atividade->data}}
                                  </div>

                                  <div class="col-md-6" align="justify">
                                    <strong>Descrição: </strong>{{$atividade->descricao}}
                                  </div>
                                </div>
                              </div>

                              <div class="modal-footer">
                                @if($objetivo->user->id == \Auth::user()->id)
                                  @if($atividade->concluido == false)

                                    <a class="btn btn-primary" href={{ route("atividade.editar" , ['id_atividade' => $atividade->id]) }}>
                                      Editar
                                    </a>

                                    <a class="btn btn-primary" href={{ route("atividade.concluir" , ['id_atividade' => $atividade->id]) }}>
                                      Finalizar
                                    </a>

                                    <a class="btn btn-danger" onclick="return confirm('\Confirmar exclusão da atividade {{$atividade->titulo}}?')" href={{ route("atividade.excluir" , ['id_atividade' => $atividade->id]) }}>
                                      Excluir
                                    </a>

                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button> -->
                                  @elseif($atividade->concluido == true)
                                    <a class="btn btn-primary" href={{ route("atividade.desconcluir" , ['id_atividade' => $atividade->id]) }}>
                                      Reabrir
                                    </a>
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>

                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="alert alert-info">
                  <strong>Não há nenhuma atividade cadastrada.</strong>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="row col-md-12">
          <div id="sugestoes">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-6">
                  <h3>
                    <strong>Sugestões</strong>
                  </h3>
                </div>

                <div class="col-md-6 text-right" style="margin-top:20px">
                  @if(App\Gerenciar::where('user_id','=',\Auth::user()->id)->where('aluno_id','=',$aluno->id)->first() != null && $objetivo->user->id != \Auth::user()->id)
                    <a class="btn btn-primary" href="{{ route("sugestoes.cadastrar" , ['id_objetivo' => $objetivo->id])}}">
                      Nova Sugestão
                    </a>
                  @endif
                </div>
              </div>

              <hr style="border-top: 1px solid black;">
            </div>

            <div class="panel-body">

              @if (\Session::has('sugestao'))
                <div class="alert alert-success">
                  <strong>Sucesso!</strong>
                  {!! \Session::get('sugestao') !!}
                </div>
              @endif

              @if(count($sugestoes) != 0)
                <div id="tabela" class="table-responsive">
                  <table class="table table-striped" id="table2">
                    <thead>
                      <tr>
                        <th style="width:20%;cursor:pointer;" onclick="sortTable(0, 'table2')">
                          AUTOR <img class="on-contrast-force-white" src="{{asset('images/sort.png')}}" style="height:15px">
                        </th>
                        <th style="width:30%;cursor:pointer;" onclick="sortTable(1, 'table2')">
                          TÍTULO <img class="on-contrast-force-white" src="{{asset('images/sort.png')}}" style="height:15px">
                        </th>
                        <th style="width:25%;cursor:pointer;" onclick="sortTable(2, 'table2')">
                          DATA <img class="on-contrast-force-white" src="{{asset('images/sort.png')}}" style="height:15px">
                        </th>
                        <th style="width:25%">Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sugestoes as $sugestao)
                        <tr>
                          <td data-title="Autor">
                            {{ explode(" ", $sugestao->user->name)[0]}}
                          </td>
                          <td data-title="Atividades">
                            {{ $sugestao->titulo }}
                          </td>
                          <td data-title="Data">{{ $sugestao->data }}</td>
                          <td data-title="Ação">
                            @if($sugestao->user->id == \Auth::user()->id)
                              <a class="btn btn-primary" href={{ route("sugestao.ver", ["id_sugestao" => $sugestao->id]) }}>Gerenciar</a>
                            @else
                              <a class="btn btn-primary" href={{ route("sugestao.ver", ["id_sugestao" => $sugestao->id]) }}>Ver</a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="alert alert-info">
                  <strong>Não há nenhuma atividade cadastrada.</strong>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<style>
  .output span { display:inline-block; width:20px; height:20px; border-radius:50%; }
</style>

<script type="text/javascript">
  $('#summer').summernote({
    placeholder: 'Escreva sua mensagem aqui...',
    lang: 'pt-BR',
    tabsize: 2,
    height: 100
  });

  function sortTable(n, table) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(table);
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /* Check if the two rows should switch place,
        based on the direction, asc or desc: */
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Each time a switch is done, increase this count by 1:
        switchcount ++;
      } else {
        /* If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again. */
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
</script>

@endsection
