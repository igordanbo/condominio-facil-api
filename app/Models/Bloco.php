<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloco extends Model
{

    use HasFactory;
    protected $fillable = ['nome', 'condominio_id', 'sindico_id'];

    public function condominio()
    {
        return $this->belongsTo(Condominio::class);
    }

    public function apartamentos()
    {
        return $this->hasMany(Apartamento::class);
    }

    public function sindico()
    {
        return $this->belongsTo(User::class, 'sindico_id');
    }

    public function manutencoes()
{
    return $this->hasMany(\App\Models\ManutencaoProgramada::class);
}
}
