<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Despesas\StoreUpdateDespesaFormRequest;
use App\Models\Despesas;
use Illuminate\Support\Facades\DB;
use App\Notifications\NotificarUsuarioNovaDespesa;
use Illuminate\Support\Facades\Notification;


class DespesasController extends Controller
{

    private $despesas;
    public function __Construct(Despesas $despesas){
        $this->despesas = $despesas;
    }

    public function index()
    {
        $user = auth()->user();
        $despesas = DB::table('despesas')
            ->join('usuarios', 'despesas.usuarios_id' , '=', 'usuarios.id')
            ->select('despesas.*', 'usuarios.nome')
            ->where('usuarios_id', $user->id)
            ->orderByDesc('despesas.data')
            ->get();

        return $despesas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateDespesaFormRequest $request)
    {
        if(!is_null($request)) {
            $despesa = $this->despesas->create($request->all());
            $usuario = auth()->user();

            Notification::send($usuario, new NotificarUsuarioNovaDespesa($despesa));
            return $despesa;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id) {
            $despesa = DB::table('despesas')
                ->select('*')
                ->where('id', $id)
                ->get();

            if(sizeof($despesa) > 0){
                return $despesa;
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateDespesaFormRequest $request, $id)
    {
        $despesa = $this->despesas->find($id);
        $this->authorize('visualizarDespesa', $despesa);
        if($despesa && !is_null($request)){
            $despesa->descricao = $request->descricao;
            $despesa->data = $request->data;
            $despesa->usuarios_id = $request->usuarios_id;
            $despesa->valor = $request->valor;
            return $despesa->save();
        }else{
            return Response(['data' => 'Não foi possivel atualizar o usuário'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $despesa = $this->despesas->find($id);
        $this->authorize('visualizarDespesa', $despesa);
        if($despesa) {
            return $this->despesas->destroy($id);
        }
    }
}
