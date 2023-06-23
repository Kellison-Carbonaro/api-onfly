<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'senha', 'created_at', 'updated_at'];

    public function despesa(){
        return $this->hasMany(Despesas::class);
    }
}
