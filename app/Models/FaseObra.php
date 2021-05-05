<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaseObra extends Model
{
    use HasFactory;

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
        return $this->hasOne(Obra::class, 'id', 'obra')->where('status_db', 1)->first();
    }

    public function fase()
    {
        return $this->hasOne(Fase::class, 'id', 'fase')->where('status_db', 1)->first();
    }
}
