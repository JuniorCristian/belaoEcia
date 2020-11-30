<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    public function obras()
    {
        return $this->hasMany(Obra::class, 'cliente', 'id');
    }
}
