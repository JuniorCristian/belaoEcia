<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = "materiais";
    protected $primaryKey = "id";
    protected $fillable = [
        "nome",
        "marca",
        "unidade",
        "descricao",
        "imagem",
    ];
}
