<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
  * Where to redirect users after login.
  *
  * @var string
  */
  protected $redirectTo = '/home';
  protected $username;

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
    $this->username = $this->findUsername();
  }

  /**
  * Get the login username to be used by the controller.
  *
  * @return string
  */
  public function findUsername()
  {
    $login = request()->input('login');

    $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    request()->merge([$fieldType => $login]);

    return $fieldType;
  }

  public function username()
  {
    return $this->username;
  }

  protected function authenticated(Request $request, $user){
    if ( $user->cadastrado ){
      return redirect()->route('home');
    } else{
      return redirect()->route("usuario.completarCadastro");
    }
  }
}
