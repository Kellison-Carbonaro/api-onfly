<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    use HasFactory;

    protected $fillable = ['descricao', 'data', 'valor', 'usuarios_id', 'created_at', 'updated_at'];

    public function Usuarios(){
        return $this->belongsTo(Usuarios::class);
    }
}
