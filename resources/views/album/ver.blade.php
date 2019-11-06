@extends('layouts.principal')
@section('title','Ver álbum')
@section('path','Início')

@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href="{{route('album.listar', $aluno->id) }}"> Álbuns</a>
> Fotos do Álbum: <strong>{{$album->nome}}</strong>
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <div class="row">

            <div class="col-md-6">
              <h3>
                <strong>
                  Álbum:
                </strong>
                {{ucfirst($album->nome)}}
              </h3>

              <h3>
                <strong>
                  Autor:
                </strong>
                {{ucfirst($album->user->name)}}
              </h3>

              @if($album->descricao != null)
                <h3>
                  <strong>
                    Descricão:
                  </strong>
                  {{ucfirst($album->descricao)}}
                </h3>
              @endif
            </div>

            <div class="col-md-6 text-right" style="margin-top:20px">
              @if($album->user->id == \Auth::user()->id)
                <a class="btn btn-primary" href="{{route("album.editar" , ['id_album'=>$album->id,]) }}">
                  <!-- <i class="material-icons">edit</i> -->
                  Editar
                </a>
                <a class="btn btn-danger" onclick="return confirm('\Confirmar exclusão do album {{$album->nome}}?')" href="{{route("album.excluir" , ['id_album'=>$album->id]) }}">
                  <!-- <i class="material-icons">delete</i> -->
                  Excluir
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

          <div class="row" align="center">

            <table id="tabela_albuns">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php
                  $colunas = 0;
                  $size = 4;
                  $tresFotos = array();
                @endphp

                @foreach ($fotos as $foto)
                  <tr>
                    @php
                      $colunas += 1;
                      array_push($tresFotos, $foto);
                    @endphp

                    @if($colunas % $size == 0)
                      @for($i = 1; $i <= $size; $i++ )
                        @php($foto = array_pop($tresFotos))
                        <td>
                          <a href="{{asset('storage/albuns/'.$aluno->id.'/'.$foto->imagem)}}" style="width:auto; height:auto;" data-lightbox="fotos">
                            <img src="{{asset('storage/albuns/'.$aluno->id.'/'.$foto->imagem)}}" style="width:200px; border:solid; height: 200px; object-fit: cover;">
                          </a>
                          &nbsp; &nbsp;
                          <br>
                          &nbsp; &nbsp;
                        </td>
                      @endfor
                    @endif

                  </tr>
                @endforeach

                @for($i = 1; $i <= $size; $i++ )
                  @php($foto = array_pop($tresFotos))
                  @if($foto != null)
                    <td>
                      <a href="{{asset('storage/albuns/'.$aluno->id.'/'.$foto->imagem)}}" style="width:auto; height:auto;" data-lightbox="fotos">
                        <img src="{{asset('storage/albuns/'.$aluno->id.'/'.$foto->imagem)}}" style="width:200px; border:solid; height:200px; object-fit: cover;">
                      </a>
                      &nbsp; &nbsp;
                      <br>
                      &nbsp; &nbsp;
                    </td>
                  @endif
                @endfor
              </tbody>
            </table>

          </div>

        </div>

        <!-- <div class="panel-footer">
          <a class="btn btn-danger" href="{{route("album.listar" , ['id_aluno'=>$aluno->id])}}">
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
