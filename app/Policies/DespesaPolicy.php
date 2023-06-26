<?php

namespace App\Policies;

use App\Models\Usuarios;
use App\Models\Despesas;
use Illuminate\Auth\Access\HandlesAuthorization;

class DespesaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function visualizarDespesa(Usuarios $usuario, Despesas $despesa){
        return $usuario->id === $despesa->usuarios_id;
    }
}
