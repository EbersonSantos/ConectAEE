<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/aee.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/lmts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lmts-app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contrast.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- JavaScripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Scripts -->
    <script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <!-- Summernote -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/lang/summernote-pt-BR.js"></script>

  </head>

  <body class="acessibilidade">
      <div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
        <ul id="menu-barra-temp" style="list-style:none;">
          <li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED">
            <a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a>
          </li>
          <li>
            <a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a>
          </li>
        </ul>
      </div>

      <!-- Barra de Logos -->
      <div id="barra-logos" class-"container" style="background:#ffffff; margin-top: 1px; height: 200px; padding: 10px 10px 10px 10px">
          <ul id="logos" style="list-style:none;">
              <li style="margin-right:140px; margin-left:110px; border-right:1px">
                  @if(Auth::check() && (Auth::user()->username == 'adelino.lmts' || Auth::user()->username == 'alana.lmts' || Auth::user()->username == 'mateus.lmts' || Auth::user()->username == 'eberson.lmts'))
                      <a href="{{ route("home") }}"><img src="{{asset('images/pikachinho.png')}}" style = "margin-left: 8px; margin-top:5px " height="170px" align = "left" ></a>
                  @else
                      <a href="{{ route("home") }}"><img src="{{asset('images/aee.png')}}" style = "margin-left: 8px; margin-top:5px " height="170px" align = "left" ></a>
                  @endif

                  <a target="_blank" href="http://lmts.uag.ufrpe.br/">
                    <img class="on-contrast-force-white" src="{{asset('images/lmts3.png')}}" style = "margin-left: 8px; margin-top:65px " height="80" align = "right" >
                  </a>

                  <img class="on-contrast-force-white" src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 65px" height="70" align = "right">

                  <a target="_blank" href="http://ww3.uag.ufrpe.br/">
                    <img class="on-contrast-force-white" src="{{asset('images/uag.png')}}" style = "margin-left: 10px; margin-top: 65px" height="80" width="70" align = "right" >
                  </a>

                  <img class="on-contrast-force-white" src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 65px" height="70" align = "right" >

                  <a target="_blank" href="http://www.ufrpe.br/">
                    <img class="on-contrast-force-white" src="{{asset('images/ufrpe.png')}}" style = "margin-left: 15px; margin-right: -10px; margin-top: 65px " height="80" width="70" align = "right">
                  </a>
              </li>
          </ul>
      </div>

      <div style="background-color:#12583C;padding-left:35px;">
        &nbsp;&nbsp;
        <a onclick="contraste()" id="altocontraste" data-toggle="tooltip" title="Contraste">
          <img class="on-contrast-force-white" src="{{asset('images/contraste.png')}}" style="height:25px">
        </a>
      </div>

        <!-- <a class="btn-primary" id="altocontraste" onclick="contraste()">Contraste</a> -->
        <!-- <button class="btn-info" onClick="fonte('a');">A+</button>
        <button class="btn-info" onClick="fonte('d');">A-</button> -->

      <div id="page-container" style="background-color:#FFFFFF">
        <div id="content-wrap">
          @yield('content')
          <br><br><br>
        </div>

        <div id="footer-brasil"></div>

      </div>

    <!-- Scripts -->
    @include('layouts.scripts')
  </body>

</html>
