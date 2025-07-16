<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManutencaoProgramada extends Model
{

    use HasFactory;
    protected $table = 'manutencao_programadas';

    protected $fillable = [
        'tipo_manutencao_id',
        'condominio_id',
        'bloco_id',
        'apartamento_id',
        'data_agendada',
        'data_conclusao',
        'status',
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoManutencao::class, 'tipo_manutencao_id');
    }

    public function condominio()
    {
        return $this->belongsTo(Condominio::class);
    }

    public function bloco()
    {
        return $this->belongsTo(Bloco::class);
    }

    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class);
    }
}
