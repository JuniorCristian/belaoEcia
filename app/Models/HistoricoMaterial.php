<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoMaterial extends Model
{
    use HasFactory;
    protected $table = "historico_materiais";
    protected $primaryKey = "id";
    protected $fillable = [
        'material',
        'loja',
        'data',
        'preco'
    ];

    public function loja()
    {
        return $this->belongsTo(Loja::class, 'loja', 'id', 'id')->first();
    }
}
