<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faltas_Obra extends Model
{
    protected $table='faltas_obras';

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra', 'id');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario', 'id');
    }
}
