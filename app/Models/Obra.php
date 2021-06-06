<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obra extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'obras';
    protected $fillable = [
        'cliente',
        'orcamento',
        'orcamento_material',
        'has_orcamento_material',
        'data_inicio_prevista',
        'data_final_prevista',
        'data_inicio',
        'data_final',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'status_db'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente', 'id');
    }

    public function funcionario()
    {
        return $this->belongsToMany(Funcionario::class, 'funcionarios_obras', 'obra', 'funcionario');
    }

    public function faltas()
    {
        return $this->hasMany(Faltas_Obra::class, 'obra', 'id');
    }

    public function fase_obra()
    {
        return $this->hasMany(FaseObra::class, 'obra', 'id');
    }

    public function fases()
    {
        return $this->belongsToMany(Fase::class, 'fase_obras', 'obra', 'fase');
    }
}
