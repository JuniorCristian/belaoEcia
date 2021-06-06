<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loja extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="lojas";
    protected $fillable=[
        'nome',
        'descricao',
        'telefone',
        'site',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'status',
    ];
}
