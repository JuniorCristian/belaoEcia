<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fases';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'status',
        'status_db'
    ];


    public function fase_obra()
    {
        return $this->hasOne(FaseObra::class, 'fase', 'id')->first();
    }

    public function materiais_fase()
    {
        return $this->belongsTo(MateriaisObraFase::class, 'fase', 'id');
    }
}
