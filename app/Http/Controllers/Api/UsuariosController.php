<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;


class UsuariosController extends Controller
{
    private $usuarios;
    public function __Construct(Usuarios $usuarios){
        $this->usuarios = $usuarios;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->usuarios->paginate(10);
        // $usuarios = Usuarios::all();
        // return response()->json(['usuarios'=> app/Http/Controllers/UsuariosController.php$usuarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return $this->usuarios->create($request->all());
        // if(!is_null($request)) {
        //     $request['password'] = bcrypt($request['password']);

        //     $this->usuarios->create($request->all());

        //     return Response(['data' => 'Usuário criado com sucesso'], 200);
        // }

        // return Response(['data' => 'Erro ao criar usuário'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
