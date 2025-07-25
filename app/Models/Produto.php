<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'preco', 'condominio_id'];

    public function condominio()
    {
        return $this->belongsTo(Condominio::class);
    }
}
