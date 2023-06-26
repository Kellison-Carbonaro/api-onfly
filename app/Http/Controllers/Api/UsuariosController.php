<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuarios\LoginUsuarioFormRequest;
use App\Http\Requests\Usuarios\StoreUpdateUsuarioFormRequest;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UsuariosController extends Controller
{
    private $usuarios;
    public function __Construct(Usuarios $usuarios){
        $this->usuarios = $usuarios;
    }
    public function index()
    {
        return $this->usuarios->all();
    }

    public function store(StoreUpdateUsuarioFormRequest $request)
    {
        if(!is_null($request)) {
            $request['password'] = bcrypt($request['senha']);
            return $this->usuarios->create($request->all());
        }
    }

    public function show($id)
    {
        if($id) {
            $usuarios = DB::table('usuarios')
                ->select('*')
                ->where('id', $id)
                ->get();

            if(sizeof($usuarios) > 0){
                return $usuarios;
            }
        }
    }

    public function update(StoreUpdateUsuarioFormRequest $request, $id)
    {
        $usuarios = $this->usuarios->find($id);

        if($usuarios && !is_null($request)){
            $usuarios->nome = $request->nome;
            $usuarios->email = $request->email;
            $usuarios->senha = bcrypt($request['password']);
            return $usuarios->save();
        }else{
            return Response(['data' => 'Não foi possivel atualizar o usuário'], 500);
        }
    }

    public function destroy($id)
    {
        $usuario = $this->usuarios->find($id);
        if($usuario) {
            return $this->usuarios->destroy($id);
        }
    }

    public function login(LoginUsuarioFormRequest $request){
        if(Auth::attempt($request->all())) {
            $usuario = Auth::user();
            $token =  $usuario->createToken('AccessToken')->plainTextToken; 
            if (Auth::check()) {
                return Response(['data' => Auth::user(), 'token' => $token], 200);
            }
        }
        
        return response()->json(['error' => 'acesso negado'], 401);
    }
}
