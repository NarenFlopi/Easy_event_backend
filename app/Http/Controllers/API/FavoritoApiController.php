<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorito;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class FavoritoApiController extends Controller
{
    public function index()
    {
        $favoritos = Favorito::all();
        foreach ($favoritos as $favorito) {
            $favorito->producto;
        }
        return response()->json(['Favoritos' => $favoritos]);
    }

    public function store(Request $request)
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Verificar si el producto ya está en favoritos
        $favoritoExis = Favorito::where('user_id', $usuario->id)
                                ->where('producto_id', $request->producto_id)
                                ->first();

        if ($favoritoExis) {
            return response()->json(['mensaje' => 'El producto ya está en favoritos']);
        }

        // Agregar favorito usando Eloquent
        Favorito::create([
            'user_id' => $usuario->id,
            'producto_id' => $request->producto_id,
        ]);

        return response()->json(['mensaje' => 'Producto agregado a favoritos']);

    }

    public function show($id)
    {
        // Obtener y mostrar detalles de un favorito específico
        $favoritos = Favorito::where('user_id', $id)->get();

        if (!$favoritos) {
            return response()->json(['mensaje' => 'Favorito no encontrado'], 404);
        }

        foreach ($favoritos as $favorito) {
            $favorito->producto;
        }

        return response()->json(['Favorito' => $favorito]);
    }

    public function update(Request $request, $id)
    {
        // Actualizar datos en la base de datos
        $favorito = Favorito::find($id);

        if (!$favorito) {
            return response()->json(['mensaje' => 'Favorito no encontrado'], 404);
        }

        // Validar y actualizar los datos
        $request->validate([
            // Agrega las reglas de validación según tus necesidades
        ]);

        $favorito->update($request->all());

        return response()->json(['mensaje' => 'Favorito actualizado correctamente']);
    }

    public function destroy($id)
    {

        $usuario = Auth::user();

        // Buscar y eliminar producto de favoritos
        $favorito = Favorito::where('user_id', $usuario->id)
                            ->where('producto_id', $id)
                            ->first();

        if (!$favorito) {
            return response()->json(['mensaje' => 'Favorito no encontrado'], 404);
        }

        $favorito->delete();

        return response()->json(['mensaje' => 'Producto eliminado de favoritos']);
    }

    public function eliminarFavorito(Request $request)
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Buscar y eliminar producto de favoritos
        $favorito = Favorito::where('user_id', $usuario->id)
                            ->where('producto_id', $request->producto_id)
                            ->first();

        if (!$favorito) {
            return response()->json(['mensaje' => 'Favorito no encontrado'], 404);
        }


        $favorito->delete();

        return response()->json(['mensaje' => 'Producto eliminado de favoritos']);
    }

    public function listarfavoritos()
    {
        $user = Auth::user();
        $favoritos = Favorito::where('user_id', $user->id)->get();
        foreach ($favoritos as $favorito) {
                $favorito->producto;
        }
        return response()->json(['Favorito' => $favoritos]);
    }
}
