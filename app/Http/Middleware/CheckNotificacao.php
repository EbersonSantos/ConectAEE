<?php

namespace App\Http\Middleware;
use Auth;
use App\Notificacao;
use Closure;

class CheckNotificacao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!Auth::check()){
          return redirect('/')->with('denied', 'É necessário estar logado para acessar o sistema');
        }else if(Auth::user()->cadastrado == false){
          return redirect()->route('usuario.completarCadastro');
        }

        $notificacao = Notificacao::find($request->route('id_notificacao'));

        if($notificacao != NULL && Auth::user()->id == $notificacao->destinatario_id){
          return $next($request);
        }else{
          return redirect('home')->with('denied','Você não tem permissão para acessar esta página ou ela não existe.');
        }
    }
}
