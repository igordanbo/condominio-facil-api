<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{

    use HasFactory;
    protected $fillable = ['nome', 'cnpj', 'endereco', 'cidade', 'uf', 'telefone', 'email', 'responsavel_id'];

    public function blocos()
    {
        return $this->hasMany(Bloco::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function manutencaos()
    {
        return $this->hasMany(ManutencaoProgramada::class);
    }

    public function sindico()
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }
}
