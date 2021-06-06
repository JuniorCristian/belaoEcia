<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaseObra extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fase_obras';
    protected $primaryKey = 'id';
    protected $fillable = [
        'obra',
        'fase',
        'inicio',
        'final',
        'inicio_previsto',
        'final_previsto'
    ];

    public function obra()
    {
        return $this->hasOne(Obra::class, 'id', 'obra');
    }

    public function fase()
    {
        return $this->hasOne(Fase::class, 'id', 'fase')->first();
    }
}
