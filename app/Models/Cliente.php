<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Model
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'clientes';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha', 'remember_token',
    ];

    protected $fillable = [
        'email', 'senha'
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function obras()
    {
        return $this->hasMany(Obra::class, 'cliente', 'id')->where('status_db', 1);
    }
}
