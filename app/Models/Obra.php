<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $table = 'obras';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente', 'id')->where('status_db', 1);
    }

    public function funcionario()
    {
        return $this->belongsToMany(Funcionario::class, 'funcionarios_obras', 'obra', 'funcionario')->where('status_db', 1);
    }

    public function faltas()
    {
        return $this->hasMany(Faltas_Obra::class, 'obra', 'id');
    }
}
