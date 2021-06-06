<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "materiais";
    protected $primaryKey = "id";
    protected $fillable = [
        "nome",
        "marca",
        "unidade",
        "sku",
        "mpn",
        "descricao",
        "imagem",
    ];

    public function lista()
    {
        return $this->hasMany(HistoricoMaterial::class, 'material', 'id');
    }

    public function lojas()
    {
        return $this->belongsToMany(Loja::class, 'materiais_obra_fases', 'material', 'loja');
    }

    public function precoLojas()
    {
        return $this->belongsToMany(Loja::class, 'historico_materiais', 'material', 'loja');
    }
}
