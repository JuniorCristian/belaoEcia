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
        'inicio',
        'final',
        'inicio_previsto',
        'final_previsto'
    ];
}
