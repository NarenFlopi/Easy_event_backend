<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sanciones;
use Illuminate\Http\Request;

class SancionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sanciones = Sanciones::all();
        return response()->json(['Sanciones' => $sanciones]);
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
            'motivo_reporte' => 'required|string',
            'estado' => 'required|string',
            'user_id' => 'required',
            'usuario_reportado' => 'required',
        ]);

        $sancion = Sanciones::create([
                'motivo_reporte' => $request->motivo_reporte,
                'estado' => $request->estado,
                'motivo_sancion' => $request->motivo_sancion,
                'duracion' => $request->duracion,
                'user_id' => $request->user_id,
                'usuario_reportado' => $request->usuario_reportado,

        ]);

        return response()->json(['Sancion' => $sancion], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sancion = Sanciones::find($id);
        return response()->json($sancion, 200);
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
        $sancion = Sanciones::find($id);

        if(!$sancion){
            return response()->json(['error' => 'Sancion no encontrada'], 404);
        }
        // eliminamos el producto
        $sancion->delete();

        return response()->json(['message'=>'Sancion eliminada'], 200);
    }
}
