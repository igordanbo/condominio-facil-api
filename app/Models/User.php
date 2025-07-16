<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['tipo', 'nome', 'email', 'cpf', 'idade', 'observacao', 'password'];

    // apartamentos que este usuário possui
    public function apartamentos()
    {
        return $this->hasMany(Apartamento::class, 'dono_id');
    }

    // prédios ou condomínios que ele administra
    public function blocosSindico()
    {
        return $this->hasMany(Bloco::class, 'sindico_id');
    }

    public function condominiosSindico()
    {
        return $this->hasMany(Condominio::class, 'responsavel_id');
    }
}
