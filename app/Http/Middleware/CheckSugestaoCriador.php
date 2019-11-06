<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Sugestao;
use App\Gerenciar;

class CheckSugestaoCriador
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

      $sugestao = Sugestao::find($request->route('id_sugestao'));

      if($sugestao == NULL || $sugestao->user->id != Auth::user()->id){
        return redirect("/")->with('denied','Você não tem permissão para acessar esta página ou ela não existe.');
      }

      return $next($request);
    }
}
