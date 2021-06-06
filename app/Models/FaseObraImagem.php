<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaseObraImagem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fase_obra_imagens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fase_obra',
        'path',
        'thumb_path',
        'descricao',
        'status_db'
    ];
}
