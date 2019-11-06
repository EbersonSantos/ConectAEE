@extends('layouts.principal')
@section('title','Listar álbuns')
@section('path','Início')

@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> Álbuns
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-12">
              <div style="width: 100%; margin-left: 0%;" class="row">
                <div style="width: 50%; float: left; margin-left:-20px;" class="col-md-6">
                  <h3>
                    <strong>Álbuns</strong>
                  </h3>
                </div>
                <div style="width:50%; float:right; margin-right:-25px;margin-top:20px" class="col-md-6 text-right">
                  <a class="btn btn-primary" href="{{route("album.cadastrar" , ['id_aluno'=>$aluno->id])}}">
                    Novo Álbum
                  </a>
                </div>
              </div>
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

            <table id="tabela_albuns" class="table-responsive">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php
                  $colunas = 0;
                  $size = 6;
                  $tresAlbuns = array();
                @endphp

                @foreach($albuns as $album)
                  <tr>
                    @php
                      $colunas += 1;
                      array_push($tresAlbuns, $album);
                    @endphp

                    @if($colunas % $size == 0)
                      @for($i = 1; $i <= $size; $i++ )
                        @php($album = array_pop($tresAlbuns))
                        <td class="text-center">
                          <a href="{{route('album.ver', ['id_album'=>$album->id])}}">
                            <img style="width:160px; border:solid; height: 160px; object-fit: cover;" src="{{asset('storage/albuns/'.$aluno->id.'/'.$album->fotos[0]->imagem)}}">
                          </a>
                          &nbsp;&nbsp;
                          <br><br>

                          <strong>
                            <?php
                              echo ucfirst($album->nome);
                            ?>
                          </strong>
                        </td>
                      @endfor
                    @endif
                  </tr>
                @endforeach

                @for($i = 1; $i <= $size; $i++ )

                  @php($album = array_pop($tresAlbuns))

                  @if($album != null)
                    <td class="text-center">
                      <a href="{{route('album.ver', ['id_album'=>$album->id])}}">
                        <img style="border:solid; width:160px; height: 160px; object-fit: cover;" src="{{asset('storage/albuns/'.$aluno->id.'/'.$album->fotos[0]->imagem)}}">
                      </a>
                      &nbsp; &nbsp;
                      <br><br>

                      <strong>
                        <?php
                          echo ucfirst($album->nome);
                        ?>
                      </strong>
                    </td>
                  @endif
                @endfor

              </tbody>
            </table>

          </div>

          @if(count($albuns) == 0)
            <div class="alert alert-info">
              <strong> Nenhum álbum cadastrado.</strong>
            </div>
          @endif

          <div class="text-center">
            {{$albuns->links()}}
          </div>

        </div>

        <!-- <div class="panel-footer">
          <a class="btn btn-danger" href="{{route("aluno.gerenciar" , ['id_aluno'=>$aluno->id])}}">
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
$(document).ready( function () {
  $('#tabela_dados').DataTable( {
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
    },
    "columnDefs": [
      { "orderable": false, "targets": 1 }
    ]
  });
});
</script>

@endsection
