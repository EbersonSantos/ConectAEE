<nav class="navbar-default" style="background-color: #12583c; border-color: #d3e0e9" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse" style="margin-left:5%">
    <ul class="nav navbar-nav" >
      @if(Auth::check() && Auth::user()->cadastrado)
        <li class="dropdown">
          <a class="menu-principal" href="{{ route('home') }}">Início</a>
        </li>
        <!-- <li class="dropdown">
          <a class="menu-principal" href="#" id="altocontraste" onclick="contraste()">Contraste</a>
        </li> -->
      @elseif(Auth::check() && !Auth::user()->cadastrado)
        <li class="dropdown">
          <a class="menu-principal" href="{{ route('usuario.completarCadastro') }}">Início</a>
        </li>
      @endif
    </ul>
    <ul class="nav navbar-nav" >
      @if(Auth::check() && Auth::user()->cadastrado)
        <li class="dropdown">
          <a href="{{ route('aluno.listar') }}">
            Alunos
            <!-- <span class="caret"></span> -->
          </a>
          <!-- <ul class="dropdown-menu" role="menu">
            <li>
              <a href="{{ route('aluno.listar') }}">
                Listar
              </a>
            </li>
            <li>
              <a href="{{ route('aluno.buscar') }}">
                Buscar por matrícula
              </a>
            </li>
          </ul> -->
        </li>
        <li class="dropdown">
          <a href="{{ route('instituicao.listar') }}">
            Instituições
          </a>
          <!-- <ul class="dropdown-menu" role="menu">
            <li>
              <a href="{{ route('instituicao.listar') }}">
                Listar
              </a>
            </li>
            <li>
              <a href="{{ route('instituicao.cadastrar') }}">
                Cadastrar
              </a>
            </li>
          </ul> -->
        </li>
      @endif
    </ul>
    <ul class="nav navbar-nav navbar-right" style="margin-right:5%">
      @if(Auth::check() && Auth::user()->cadastrado)
        @php
          $notificacoes = Auth::user()->notificacoes;
          $lidos = (array_column($notificacoes->toArray(), 'lido'));
          $qtd_naolidos = count(array_keys($lidos, false));
        @endphp

        <li class="dropdown">
          <a onclick="contraste()" id="altocontraste" data-toggle="tooltip" title="Contraste">
            <img class="on-contrast-force-white" src="{{asset('images/contraste.png')}}" style="height:25px">
          </a>
        </li>
        <li class="dropdown">
          <a class="menu-principal dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            @if($lidos == null)
              Notificacões
              <!-- <i class="material-icons">notifications_none</i> -->
            @elseif(gettype(array_search(false, $lidos)) == 'integer')
              Notificacões
              <!-- <i class="material-icons">notifications</i> -->
              <span class="badge badge-pill" style="position: absolute; top:2px; right:1px; background:red">{{$qtd_naolidos}}</span>
            @else
              Notificacões
              <!-- <i class="material-icons">notifications_none</i> -->
            @endif
          </a>

          <ul class="dropdown-menu" role="menu">
            @if(count($notificacoes) != 0)
              <table class="table table-hover table-bordered">
                @php($i = 0)
                @foreach($notificacoes as $notificacao)
                  <tr>
                    @if($notificacao->lido)
                      <td data-title="Notificacao">
                    @else
                      <td class="bg-info" data-title="Notificacao">
                    @endif

                    @if($notificacao->tipo == 1)
                      <a class="btn text-center" href="{{ route('notificacao.ler', ['id_notificacao' => $notificacao->id]) }}">
                        {{$notificacao->remetente->name}} pediu para acessar os dados do(a) aluno(a) {{explode(" ", $notificacao->aluno->nome)[0]}}</br>
                      </a>
                    @elseif($notificacao->tipo == 2)
                      <a class="btn text-center" href="{{ route('notificacao.ler', ['id_notificacao' => $notificacao->id]) }}">
                        {{$notificacao->remetente->name}} lhe concedeu acesso aos dados do(a) aluno(a) {{explode(" ", $notificacao->aluno->nome)[0]}}</br>
                      </a>
                    @elseif($notificacao->tipo == 3)
                      <a class="btn text-center" href="{{ route('notificacao.ler', ['id_notificacao' => $notificacao->id]) }}">
                        {{$notificacao->remetente->name}} criou um novo objetivo para o(a) aluno(a) {{explode(" ", $notificacao->aluno->nome)[0]}}</br>
                      </a>
                    @elseif($notificacao->tipo == 4)
                      <a class="btn text-center" href="{{ route('notificacao.ler', ['id_notificacao' => $notificacao->id]) }}">
                        {{$notificacao->remetente->name}} criou uma nova atividade para o(a) aluno(a) {{explode(" ", $notificacao->aluno->nome)[0]}}</br>
                      </a>
                    @elseif($notificacao->tipo == 5)
                      <a class="btn text-center" href="{{ route('notificacao.ler', ['id_notificacao' => $notificacao->id]) }}">
                        {{$notificacao->remetente->name}} criou uma nova sugestão de atividade para o(a) aluno(a) {{explode(" ", $notificacao->aluno->nome)[0]}}</br>
                      </a>
                    @endif

                    </td>
                  </tr>
                  @break(++$i == 5)
                @endforeach
              </table>

              <li>
                <a class="text-center" href="{{ route('notificacao.listar') }}">
                  Ver todas
                </a>
              </li>

            @else
              <li>
                <a class="text-center bg-info">
                  Sem notificações
                </a>
              </li>
            @endif
          </ul>
        </li>

        <li class="dropdown">
          <a class="menu-principal dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{\Auth::user()->name}} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="{{ route('usuario.editar') }}">
                Meu Perfil
              </a>
            </li>
            <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sair
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      @elseif(Auth::check() && !Auth::user()->cadastrado)
        <li class="dropdown">
          <a class="menu-principal dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{\Auth::user()->username}} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sair
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      @else
        <li class="dropdown">
          <a onclick="contraste()" id="altocontraste" data-toggle="tooltip" title="Contraste">
            <img class="on-contrast-force-white" src="{{asset('images/contraste.png')}}" style="height:25px">
          </a>
        </li>
        <li><a class="menu-principal" href="{{ route('login') }}">Entrar</a></li>
        <li><a class="menu-principal" href="{{ route('register') }}">Cadastrar</a></li>
      @endif
    </ul>
  </div>
</nav>
