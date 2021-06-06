<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecoMaterial extends Model
{
    use HasFactory;

    protected $table = "preco_mateiais";
    protected $primaryKey = "id";
    protected $fillable = [
        'material',
        'loja',
        'data',
        'preco'
    ];
}
