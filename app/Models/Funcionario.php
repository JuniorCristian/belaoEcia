<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';


    public function obras()
    {
        return $this->belongsToMany(Obra::class, 'funcionarios_obras', 'funcionario', 'obra')->where('status_db', 1);
    }

    public function faltas()
    {
        return $this->hasMany(Faltas_Obra::class, 'funcionario', 'id');
    }
}
