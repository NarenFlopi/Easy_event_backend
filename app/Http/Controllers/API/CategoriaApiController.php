<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;


class CategoriaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$categoria = Categoria::with('producto')->get();
        $categoria = Categoria::all();
        return response()->json(['Categoria' => $categoria]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string'
        ]);

        $categoria = Categoria::create([
            'nombre' => $request->nombre

        ]);

        return response()->json(['Categoria' => $categoria], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        return response()->json($categoria, 200);

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
            'nombre' => 'required|string'
        ]); 

        $categoria = Categoria::find($id);

        if(!$categoria){
            return response()->json(['error' => 'Categoria no encontrada'], 404);
        }

        $categoria->update([
            'nombre' => $request->nombre
        ]);

        return response()->json(['message' => 'Categoria actualizada', 'Categoria'=>$categoria]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $categoria = Categoria::find($id);

        if(!$categoria){
            return response()->json(['error' => 'Categoria no encontrada'], 404);
        }
        // eliminamos el producto
        $categoria->delete();

        return response()->json(['message'=>'Categoria eliminada'], 200);

    }

}
