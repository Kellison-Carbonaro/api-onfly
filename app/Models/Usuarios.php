<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuarios extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['nome', 'email', 'password', 'created_at', 'updated_at'];
    protected $hidden = ['password', 'remember_token'];

    public function despesa(){
        return $this->hasMany(Despesas::class);
    }
}
