<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaisObraFase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'materiais_obra_fases';
    protected $primaryKey = 'id';
    protected $fillable = [
        'material',
        'loja',
        'fase_obra',
        'data_compra',
        'preco_unitario',
        'qtd',
    ];

}
