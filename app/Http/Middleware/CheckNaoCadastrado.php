<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckNaoCadastrado
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
        return $next($request);
      }else{
        return redirect('home')->with('denied','Você não tem permissão para acessar esta página ou ela não existe.');
      }
    }
}
