<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{

    use HasFactory;
    protected $fillable = ['numero', 'bloco_id', 'dono_id', 'status'];

    public function bloco()
    {
        return $this->belongsTo(Bloco::class);
    }

    public function dono()
    {
        return $this->belongsTo(User::class, 'dono_id');
    }

    public function manutencaos()
    {
        return $this->hasMany(ManutencaoProgramada::class);
    }
}
