<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    use HasFactory;

    protected $fillabel = ['descricao', 'data', 'valor', 'usuario_id'];

    public function Usuarios(){
        return $this->belongsTo(Usuarios::class);
    }
}
