@extends('layouts.principal')
@section('title','Editar álbum')
@section('path','Início')

@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href="{{route('album.listar', $aluno->id) }}"> Álbuns</strong></a>
> <a href="{{route('album.ver' , ['id_album'=>$album->id]) }}">Fotos de: <strong>{{$album->nome}}</strong> </a>
> Editar
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="panel-heading col-md-12">
          <h2>
            <strong>
              Editar Álbum
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading" style="margin-top:11px;">
              <h3>
                <strong>
                  Dados do Álbum
                </strong>
              </h3>

              <hr style="border-top: 1px solid black;">
            </div>

            <div class="panel-body panel-body-cadastro">
              <form method="POST" action="{{ route("album.atualizar") }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input id="id_aluno" type="hidden" class="form-control" name="id_aluno" value="{{ $aluno->id }}">
                <input id="id_album" type="hidden" class="form-control" name="id_album" value="{{ $album->id }}">

                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                  <label for="nome" class="col-md-12 control-label"> Nome <font color="red">*</font> </label>

                  <div class="col-md-12">
                    @if(old('nome',NULL) != NULL)
                      <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" autofocus>
                    @else
                      <input id="nome" type="text" class="form-control" name="nome" value="{{ $album->nome }}">
                    @endif

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
                    @if(old('descricao',NULL) != NULL)
                      <textarea id="descricao" rows = "5" cols = "50" class="form-control" name="descricao">{{ old('descricao') }}</textarea>
                    @else
                      <textarea id="descricao" rows = "5" cols = "50" class="form-control" name="descricao">{{ $album->descricao }}</textarea>
                    @endif

                    @if ($errors->has('descricao'))
                      <span class="help-block">
                        <strong>{{ $errors->first('descricao') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group{{ $errors->has('imagens.*') || $errors->has('imagens')? ' has-error' : '' }}">
                  <label for="imagens" class="col-md-12 control-label" >
                    Adicionar mais fotos
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
        </div>

        <div class="col-md-6">
          <div class="panel panel-default">
            <form method="POST" action="{{ route("album.fotos.excluir") }}">
              {{ csrf_field() }}

              <div class="panel-heading">
                <div class="row">

                  <div class="col-md-4">
                    <h3>
                      <strong>
                        Excluir Fotos
                      </strong>
                    </h3>
                  </div>

                  <div class="row col-md-8" style="margin:13px 0px 0px 0px;">
                    <div class="col-md-8" style="margin-top:1px; padding:0px; float:left">
                      <input id="selectAll" type="checkbox" class="form-check-input" value="">
                      <label class="form-check-label" for="selectAll">Selecionar todas</label>
                    </div>
                    <div class="col-md-4" style="margin-top:8px; padding:0px; float:right">
                      <button type="submit" onclick="return confirm('\Confirmar exclusão da(s) imagem(ns) selecionadas?')" class="btn btn-danger">
                        Excluir
                      </button>
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
                  <table id="tabela_albuns">
                    <thead>
                      <tr>
                        <th></th>
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
                              <td class="text-center">
                                <a href="{{asset('storage/albuns/'.$aluno->id.'/'.$foto->imagem)}}" style="width:auto; height:auto;" data-lightbox="fotos">
                                  <img src="{{asset('storage/albuns/'.$aluno->id.'/'.$foto->imagem)}}" style="width:128px; height: 128px; object-fit: cover; border:solid;">
                                </a>
                                &nbsp; &nbsp;
                                <br>
                                <input type="checkbox" class="form-control" name="fotos[]" value="{{$foto->id}}">
                                &nbsp; &nbsp;
                              </td>
                            @endfor
                          @endif
                        </tr>
                      @endforeach

                      @php($count = 0)

                      @for($i = 1; $i <= $size; $i++ )
                        @php($foto = array_pop($tresFotos))

                        @if($foto != null)
                          @php($count += 1)
                          <td class="text-center">
                            <a href="{{asset('storage/albuns/'.$aluno->id.'/'.$foto->imagem)}}" style="width:auto; height:auto;" data-lightbox="fotos">
                              <img src="{{asset('storage/albuns/'.$aluno->id.'/'.$foto->imagem)}}" style="width:128px; height: 128px; border:solid; object-fit: cover;">
                            </a>
                            &nbsp; &nbsp;
                            <br>
                            <input type="checkbox" class="form-control" name="fotos[]" value="{{$foto->id}}">

                            <!-- <input id="fotos" type="checkbox" class="form-check-input" name="fotos[]" value="{{$foto->id}}"> -->
                            <!-- <label class="form-check-label" for="fotos">Excluir</label> -->

                            &nbsp; &nbsp;
                          </td>
                        @endif
                      @endfor
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

function show(id) {

  var fotos = <?php echo json_encode($fotos) ?>;

  for(var i in fotos){
    document.getElementById(fotos[i].id).className = "item";
  }
  document.getElementById(id).className = "item active";
}
</script>

<script src="{{ asset('js/bootstrap-filestyle.min.js')}}"> </script>

<script type="text/javascript">
  var checkedAll = false;
  var checkBoxs;

  document.getElementById("selectAll").addEventListener("click", function(){
    checkBoxs = document.querySelectorAll('input[type="checkbox"]:not([id=selectAll])');
    //"Hack": http://toddmotto.com/ditch-the-array-foreach-call-nodelist-hack/
    [].forEach.call(checkBoxs, function(checkbox) {
      //Verificamos se é a hora de dar checked a todos ou tirar;
      checkbox.checked = checkedAll ? false : true;
    });
    //Invertemos ao final da execução, caso a última tenha sido true para checar todos, tornamos ele false para o próximo clique;
    checkedAll = checkedAll ? false : true;
    //getLinhas();
  });
</script>
@endsection
