<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoManutencao extends Model
{

    use HasFactory;
    protected $table = 'tipo_manutencaos';
    protected $fillable = ['nome'];

    
    public function manutencoes()
    {
        return $this->hasMany(\App\Models\ManutencaoProgramada::class, 'tipo_manutencao_id');
    }
}
