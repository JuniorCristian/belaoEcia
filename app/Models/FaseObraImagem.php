<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaseObraImagem extends Model
{
    use HasFactory;

    protected $table = 'fase_obra_imagens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fase_obra',
        'path',
        'status_db'
    ];
}
