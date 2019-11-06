<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Gerenciar;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'telefone', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gerenciars(){
        return $this->hasMany(Gerenciar::class);
    }

    public function objetivos(){
        return $this->hasMany(Objetivo::class);
    }

    public function instituicoes(){
        return $this->hasMany(Instituicao::class);
    }

    public function feedbacks(){
        return $this->hasMany(Feedback::class);
    }

    public function albuns(){
        return $this->hasMany(Album::class);
    }

    public function notificacoes(){
        return $this->hasMany(Notificacao::class, 'destinatario_id')->orderBy('created_at', 'desc')->take(5);
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPassword($token));
    }
}
