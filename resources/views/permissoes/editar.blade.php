@extends('layouts.principal')
@section('title','Editar permissão')
@section('navbar')
<a href="{{route('aluno.listar')}}">Início</a>
> <a href="{{route('aluno.gerenciar',$aluno->id)}}">Perfil de <strong>{{ explode(" ", $aluno->nome)[0]}}</strong></a>
> <a href="{{route('aluno.permissoes',$aluno->id)}}">Acesso</a>
> Editar
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h2>
            <strong>
              Editar Acesso
            </strong>
          </h2>

          <hr style="border-top: 1px solid black;">
        </div>

        <div class="panel-body panel-body-cadastro">
          @if (\Session::has('Fail'))
            <div class="alert alert-danger">
              <strong>Erro!</strong>
              {!! \Session::get('Fail') !!}
            </div>
          @endif

          <div class="col-md-8 col-md-offset-2">
            <form autocomplete="off" method="POST" action="{{ route("aluno.permissoes.atualizar") }}">
              {{ csrf_field() }}

              <input type="hidden" name="id_permissao" value="{{$gerenciar->id}}">

              <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-12 control-label">Nome de Usuário</label>

                <div class="col-md-12">

                  <input id="username" type="text" class="form-control" name="username" value="{{ $gerenciar->user->username }}" disabled>

                  @if ($errors->has('username'))
                    <span class="help-block">
                      <strong>{{ $errors->first('username') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
                <label for="perfil" class="col-md-12 control-label">Perfil</label>

                <div class="col-md-12">
                  <select id="perfil" name="perfil" class="form-control" onchange="showEspecializacao(this)">
                    @if (old('tipo',NULL) != NULL)
                      @foreach($perfis as $perfil)
                        @if(old('perfil') == $perfil->nome)
                          <option value="{{$perfil->nome}}" selected>{{$perfil->nome}}</option>
                        @else
                          <option value="{{$perfil->nome}}">{{$perfil->nome}}</option>
                        @endif
                      @endforeach
                    @else
                      @foreach($perfis as $perfil)
                        @if($gerenciar->perfil->nome == $perfil->nome)
                          <option value="{{$perfil->nome}}" selected>{{$perfil->nome}}</option>
                        @else
                          <option value="{{$perfil->nome}}">{{$perfil->nome}}</option>
                        @endif
                      @endforeach
                    @endif
                  </select>

                  @if ($errors->has('perfil'))
                    <span class="help-block">
                      <strong>{{ $errors->first('perfil') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              @if(old('perfil') == "Profissional Externo" || $gerenciar->perfil->nome == "Profissional Externo")
                <div id="div-especializacao" class="form-group{{ $errors->has('especializacao') ? ' has-error' : '' }}" style="display: block">
              @else
                <div id="div-especializacao" class="form-group{{ $errors->has('especializacao') ? ' has-error' : '' }}" style="display: none">
              @endif
                <label for="especializacao" class="col-md-12 control-label">Especialização</label>

                <div class="autocomplete col-md-12">
                  @if(old('especializacao',NULL) != NULL)
                    <input id="especializacao" type="text" class="form-control" autocomplete="off" name="especializacao" value="{{ old('especializacao') }}">
                  @else
                    <input id="especializacao" type="text" class="form-control" autocomplete="off" name="especializacao" value="{{ $gerenciar->perfil->especializacao }}">
                  @endif

                  @if ($errors->has('especializacao'))
                    <span class="help-block">
                      <strong>{{ $errors->first('especializacao') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-check col-md-12">
                @if(old('isAdministrador',NULL) != NULL)
                  <input id="isAdministrador" type="checkbox" class="form-check-input" name="isAdministrador" value="true">
                @else
                  @if($gerenciar->isAdministrador)
                    <input id="isAdministrador" type="checkbox" class="form-check-input" name="isAdministrador" value="true" checked>
                  @else
                    <input id="isAdministrador" type="checkbox" class="form-check-input" name="isAdministrador" value="true">
                  @endif
                @endif

                <label class="form-check-label" for="isAdministrador">Usuário administrador</label>
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

<script type="text/javascript">
  document.getElementById("perfil").onchange = function() {
    var perfil = document.getElementById("perfil");

    if (perfil.selectedIndex == 0) {
      var adm = document.getElementById("isAdministrador");
      adm.checked = true;
      adm.readonly = true;
      document.getElementById("div-especializacao").style.display = "none";

      adm.onchange = function() {
        adm.checked=true;
      };
    }else if(perfil.selectedIndex == 3){
      var adm = document.getElementById("isAdministrador");
      adm.checked = false;
      adm.readonly = false;
      document.getElementById("div-especializacao").style.display = "block";
    }else{
      var adm = document.getElementById("isAdministrador");
      adm.checked = false;
      adm.readonly = false;
      document.getElementById("div-especializacao").style.display = "none";
    }
  };
</script>

<script>
  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
          });
          a.appendChild(b);
        }
      }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
      closeAllLists(e.target);
    });
  }

  var myarray = [<?php echo '"'.implode('","', $especializacoes).'"' ?>];

  /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
  autocomplete(document.getElementById("especializacao"), myarray);
</script>
@endsection
