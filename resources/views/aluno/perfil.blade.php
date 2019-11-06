@extends('layouts.principal')
@section('title','Perfil de aluno')

@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="perfil" class="panel panel-default" style="width:100%">

				<div class="panel-heading">
	        <div class="row">

	          <div class="col-md-6">
	            <h2>
	              <strong>
	                {{$aluno->nome}}
	              </strong>
	            </h2>
	          </div>

	          <div class="col-md-6 text-right" style="margin-top:20px">
							@if(App\Gerenciar::where('user_id','=',\Auth::user()->id)->where('aluno_id','=',$aluno->id)->first()->isAdministrador == true)
								<a class="btn btn-primary" data-toggle="tooltip" title="Editar aluno" href={{route("aluno.editar", ["id_aluno"=>$aluno->id]) }}>
									Editar
								</a>
								<a data-toggle="tooltip" title="Acesso ao aluno" class="btn btn-primary" href="{{route('aluno.permissoes',['id_aluno'=>$aluno->id])}}">
									Acesso
								</a>
								<a class="btn btn-danger" data-toggle="tooltip" title="Excluir aluno" onclick="return confirm('\Confirmar exclusão do aluno {{$aluno->nome}}?')" href={{route("aluno.excluir", ["id_aluno"=>$aluno->id]) }}>
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

					@php
						$gerenciars = $aluno->gerenciars;
					@endphp

					<div class="row">
						<div class="col-md-12">
							<div class="col-md-2">
								<div class="text-center">
									@if($aluno->imagem != null)
										<img src="{{asset('storage/avatars/'.$aluno->imagem)}}" style="border-radius: 60%; height:150px; width:150px; object-fit: cover;">
										<br/>
									@else
										<img src="{{asset('images/avatar.png')}}" style="border-radius: 60%; width:150px; height: 150px; object-fit: cover;">
										<br/>
									@endif
								</div>

								<br>
							</div>

							<div class="col-md-5">
								<?php
								foreach($gerenciars as $gerenciar){
									if($gerenciar->user->id == \Auth::user()->id && $gerenciar->isAdministrador){
										?>
										<strong>CPF:</strong> {{$aluno->cpf}}
										<br/>
										<?php
										break;
									}
								}
								?>

								@if($aluno->sexo == 'M')
									<strong>Sexo:</strong> Masculino
								@else
									<strong>Sexo:</strong> Feminino
								@endif

								<br/>
								<strong>Data de Nascimento:</strong> {{$aluno->data_de_nascimento}}
								<br/>
								<strong>Endereço:</strong>
								<br>
								<?php
									echo $aluno->endereco->logradouro, ", n<code>&deg;</code>",
									$aluno->endereco->numero, ", ",
									$aluno->endereco->bairro, ", ",
									$aluno->endereco->cidade, " - ",
									$aluno->endereco->estado;
								?>
							</div>

							<div class="col-md-5">
								@if($aluno->cid != null)
									<strong>CID:</strong> {{$aluno->cid}}
									<br/>
									<strong>Descrição CID:</strong> {{$aluno->descricao_cid}}
									<br/>
								@endif

								<br>
								<strong>Instituições:</strong>
								<br>

								<ul>
									@foreach ($aluno->instituicoes as $instituicao)
										<li>
											<a href="{{ route("instituicao.ver", ["id_instituiçao"=>$instituicao->id]) }}">{{$instituicao->nome}}</a>
										</li>
									@endforeach
								</ul>

							</div>
						</div>

						<div class="col-md-12">
							<div class="col-md-10 col-md-offset-2">
								@if($aluno->observacao != null)
									<strong>Observações:</strong> {!! $aluno->observacao !!}
									<br/>
								@endif
							</div>
						</div>
					</div>

					<hr style="border-top: 1px solid black;">

					<div class="row col-md-8 col-md-offset-2">
						<a href="{{route("objetivo.listar", ["id_aluno"=>$aluno->id]) }}" data-toggle="tooltip" title="Ver objetivos">
							<div class="card cartao text-center " style="border-radius: 20px">
								<div class="card-body d-flex justify-content-center">
									<h2 style="margin-top:80px;">
										<img src="{{asset('images/objetivo.png')}}" style="width:44px; height:44px;">
										<br>
										Objetivos
									</h2>
								</div>
							</div>
						</a>

						<a href="{{route("album.listar", ["id_aluno"=>$aluno->id]) }}" data-toggle="tooltip" title="Ver álbuns">
							<div class="card cartao text-center " style="border-radius: 20px">
								<div class="card-body d-flex justify-content-center">
									<h2 style="margin-top:80px;">
										<img src="{{asset('images/album.png')}}" style="width:44px; height:44px;">
										<br>
										Álbuns
									</h2>
								</div>
							</div>
						</a>

						<!-- @if(App\Gerenciar::where('user_id','=',\Auth::user()->id)->where('aluno_id','=',$aluno->id)->first()->isAdministrador == true)
							<a href="{{route('aluno.permissoes',['id_aluno'=>$aluno->id])}}">
								<div class="card cartao text-center " style="border-radius: 20px">
									<div class="card-body d-flex justify-content-center">
										<h2 style="margin-top:80px;">
											<img src="{{asset('images/acesso.png')}}" style="width:44px; height:44px;">
											<br>
											Acesso
										</h2>
									</div>
								</div>
							</a>
						@endif -->
					</div>
				</div>

				<!-- <div class="panel-footer" style="background-color:white">
          <a class="btn btn-danger" href="{{URL::previous()}}">
            <i class="material-icons">keyboard_backspace</i>
            <br>
            Voltar
          </a>
        </div> -->
		</div>

		<button class="open-button" data-toggle="tooltip" title="Ver fórum" style="border-radius:15px;" onclick="openForm()">Fórum</button>
	</div>

	@if (\Session::has('display'))
		<div class="chat-popup" id="myForm" style="display:block; background-color:white;">
	@else
		<div class="chat-popup" id="myForm" style="display:none;background-color:white; ">
	@endif
		<div class="panel-heading" id="forum" style="display:absolute;">
			<div class="row">
				<div class="col-md-6">
					<h3>
						<a target="_blank" href="{{route('aluno.forum',['id_aluno'=>$aluno->id]).'#forum'}}">
							Fórum <i class="material-icons">open_in_new</i>
						</a>
					</h3>
				</div>

				<div class="col-md-6">
					<button type="button" style="float:right; width:50px; height:44px; background-color:red; color:white; margin-top:10px;" class="btn" onclick="closeForm()">
						<i class="material-icons">close</i>
					</button>
				</div>
			</div>
		</div>

		<div class="panel" style="max-height:700px; max-width: 450px; overflow:auto; background-color: #e5ddd5">
			<div class="panel-body">

				<form class="form-horizontal" method="POST" action="{{route('aluno.forum.mensagem.enviar')}}">
					@csrf
					<input name="forum_id" type="text" value={{$aluno->forum->id}} hidden>

					<div style="margin: 1%" class="form-group">
						<textarea name="mensagem" style="width:75%; display: inline" id="summer" type="text" class="form-control summernote"></textarea>
						<br>

						@if ($errors->has('mensagem'))
							<div style="margin-left: 1%; margin-right: 1%" class="alert alert-danger">
								<strong>Erro!</strong>
								{{ $errors->first('mensagem') }}
							</div>
						@endif

						<button type="submit" class="btn btn-primary">Enviar</button>

					</div>
				</form>

				<div class="form-group">
					@foreach($mensagens as $mensagem)
						@if($mensagem->user_id == \Auth::user()->id)
							<div style="text-align: right; width: 80%; margin-left: 20%" id='user-message'>
								<div class="panel panel-default">
									<div style="background-color: #dbf6c5; color: #262626" class="panel-body">
										<div class="hifen">
											{!! $mensagem->texto !!}<br>
											{{$mensagem->created_at->format('d/m/y h:i')}}<br>
										</div>
									</div>
								</div>
							</div>
						@else
							<div style="text-align: left; width: 80%" id='others-message'>
								<div class="panel panel-default">
									<div style="background-color: white; color: #262626" class="panel-body">
										<div class="hifen">
											<strong>{{$mensagem->user->name}}:</strong><br>
											{!! $mensagem->texto !!}<br>
											{{$mensagem->created_at->format('d/m/y h:i')}}<br>
										</div>
									</div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	var width = screen.width;

	if (width <= 1000){
		document.getElementById("painel").className = "col-md-offset-1";
	}

  $('#summer').summernote({
    placeholder: 'Escreva sua mensagem aqui...',
    lang: 'pt-BR',
    tabsize: 2,
    height: 100
  });

</script>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

@endsection
