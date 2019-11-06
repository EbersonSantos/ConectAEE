@extends('layouts.principal')
@section('title','Início')
@section('path','Início')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Início</div>
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{route('login')}}">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <div class="form-group" align="center">
              <a href="{{ route("aluno.listar") }}" class="btn btn-primary " role="button" aria-pressed="true">Alunos</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
