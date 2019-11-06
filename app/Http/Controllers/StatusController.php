<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Aluno;
use App\Objetivo;
use App\Status;
use App\StatusObjetivo;
use DateTime;


class StatusController extends Controller
{
  // public function cadastrar($id_objetivo){
  //   $statuses = Status::all();
  //
  //   $objetivo = Objetivo::find($id_objetivo);
  //   $aluno = $objetivo->aluno;
  //
  //   return view("status.cadastrar", [
  //     'aluno' => $aluno,
  //     'objetivo' => $objetivo,
  //     'statuses' => $statuses
  //   ]);
  // }

  public function atualizar(Request $request){
    $validator = Validator::make($request->all(), [
      'status' => ['required'],
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $statusObjetivo = new StatusObjetivo();
    $statusObjetivo->data = new DateTime();
    $statusObjetivo->objetivo_id = $request->id_objetivo;
    $statusObjetivo->status_id = $request->status;
    $statusObjetivo->save();

    return Redirect::to(route("objetivo.gerenciar", ["id_objetivo" => $request->id_objetivo]) . "#painel0")->with('success','Status atualizado.');
  }
}
