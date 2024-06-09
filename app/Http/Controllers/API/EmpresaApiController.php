<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::all();
        return response()->json(['Empresa' => $empresa], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nit_empresa' => 'required|numeric',
            'direccion_empresa' => 'required|string',
            'nombre_empresa' => 'required|string',
            'telefono_empresa' => 'required|numeric',
            'email_empresa' => 'required|email',
            'user_id' => 'required|numeric',

        ]);

        $empresa = Empresa::create([
            'nit_empresa' => $request->nit_empresa,
            'direccion_empresa' => $request->direccion_empresa,
            'nombre_empresa' => $request->nombre_empresa,
            'telefono_empresa' => $request->telefono_empresa,
            'email_empresa' => $request->email_empresa,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['Empresa' => $empresa], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $empresa= Empresa::find($id);
        return response()->json($empresa,200);

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
        $this->validate($request, [
            'nit_empresa' => 'required|numeric',
            'direccion_empresa' => 'required|string',
            'nombre_empresa' => 'required|string',
            'telefono_empresa' => 'required|numeric',
            'email_empresa' => 'required|email',
            'user_id' => 'required|numeric',
        ]);

        $empresa = Empresa::find($id);

        if(!$empresa){
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $empresa->update([
            'nit_empresa' => $request->nit_empresa,
            'direccion_empresa' => $request->direccion_empresa,
            'nombre_empresa' => $request->nombre_empresa,
            'telefono_empresa' => $request->telefono_empresa,
            'email_empresa' => $request->email_empresa,
            'user_id' => $request->user_id,
            ]);

        return response()->json(['message' => 'Empresa actualizada', 'Empresa'=>$empresa]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $empresa = Empresa::find($id);

        if(!$empresa){
            return response()->json(['error' => 'Empresa no encontrada'], 404);
        }

        $empresa->delete();

        return response()->json(['message'=>'Empresa eliminada'], 200);
    }

}
