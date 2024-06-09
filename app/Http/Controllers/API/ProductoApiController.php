<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Favorito;
use App\Models\Empresa;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class ProductoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        if($user->rol_id == 2){
            $empresa = $user->empresa;
            $productos = Producto::where('empresa_id', $empresa->id)->get();
            return response()->json(['Producto' => $productos]);
        
        }else {
            $productos = Producto::where('cantidad_disponible', '>', 0)->get();
            
            foreach($productos as $producto){
                $empresa = Empresa::find($producto->empresa_id);
                $producto->nombre_empresa = $empresa->nombre_empresa;
            }
            
            return response()->json(['Producto' => $productos]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion de datos
        /*$this->validate($request, [
            'precio' => 'required',
            'nombre_producto' => 'required',
            'cantidad_disponible' => 'required',
        ]);*/

        $user = Auth::user();
        $empresa= $user->empresa;
        //return response()->json(['post' => $request], 404);
        // Crear un nuevo producto
        $producto = Producto::create([
            'codigo' => "1",
            'precio' => $request->precio,
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'cantidad_disponible' => $request->cantidad_disponible,
            'cantidad_inventario' => $request->cantidad_disponible,
            'categoria_id' => $request->categoria,
            'empresa_id' => $empresa->id,
        ]);

        $change=false;
        if ($request->hasFile('foto'))
        {
            $user = Auth::user();
            $fileName=$request->file('foto')->getClientOriginalName();
            $extFile=substr($fileName, strripos($fileName, "."));
            $info_foto=
            $pathi = $request->file('foto')->storeAs('public','my_files/productos/'.$user->id.'/img_'. $producto->id.".png");
            //$pathi = $request->file('foto')->storeAs('user/123/img_123_img'.$extFile,'my_files');
            
            $producto->foto = substr($pathi, stripos($pathi, "/")+1);
            $change=TRUE;

        } else
        {
            $producto->foto = "my_files/productos/no.png";
            $change=TRUE;

        }
        if ($change==TRUE) {
            $producto->save();

        }

        return response()->json([ 'message' => 'Successfully created user!'], 201);
    }

    public function search(Request $request){
        $busqueda = $request->busqueda;
        $filtro = $request->categoria;
        $categoria = Categoria::find($filtro);

        if ($categoria) {
            $producto = Producto::where('codigo', 'like', "%$busqueda%")
                            ->orWhere('nombre_producto', 'like',"%$busqueda%")
                            ->where('cantidad_disponible', '>', 0)
                            ->where('categoria_id', $categoria->id)
                            ->get();

        return response()->json(['Producto' => $producto]);
        }
        //return response()->json(['Producto' => $busqueda]);

        $producto = Producto::where('codigo', 'like', "%$busqueda%")
                            ->orWhere('nombre_producto', 'like',"%$busqueda%")
                            ->where('cantidad_disponible', '>', 0)
                            ->get();
        

        return response()->json(['Producto' => $producto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $producto = Producto::find($id);
        $favorit = Favorito::where('producto_id', $producto->id)->where('user_id', $user->id)->first();
        $empresa = Empresa::find($producto->empresa_id);
        $producto->nombre_empresa = $empresa->nombre_empresa;
        if(!$favorit) {
            $producto->favorito = false;
        } else{
            $producto->favorito = true;
        }
        return response()->json($producto,200);
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
        
        // buscar el producto por id o no se si por codigo
        $user = Auth::user();
        $empresa= $user->empresa;
        $producto = Producto::find($id);
        return response()->json(['error' => $producto], 404);
        // un if x si no se encuentra
        /*if($producto){
            return response()->json(['error' => $request], 404);
        }*/

        //nuevos datos
        /*
         $producto->update([
            'codigo' => "1",
            'precio' => $request->precio,
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'cantidad_disponible' => $request->cantidad_disponible,
            'cantidad_inventario' => $request->cantidad_disponible,
            'categoria_id' => $request->categoria,
            'empresa_id' => $empresa->id,
        ]);*/

        $producto->codigo = "1";
        $producto->precio = $request->precio;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->descripcion = $request->descripcion;
        $producto->cantidad_disponible = $request->cantidad_disponible;
        $producto->cantidad_inventario = $request->cantidad_disponible;
        $producto->categoria_id = $request->categoria;
        $producto->empresa_id = $empresa->id;
        return response()->json(['error' => $producto], 404);


        $change=false;
        if ($request->hasFile('foto'))
        {
            $user = Auth::user();
            $fileName=$request->file('foto')->getClientOriginalName();
            $extFile=substr($fileName, strripos($fileName, "."));
            $info_foto=
            $pathi = $request->file('foto')->storeAs('public','my_files/productos/'.$user->id.'/img_'. $producto->id.".png");
            //$pathi = $request->file('foto')->storeAs('user/123/img_123_img'.$extFile,'my_files');
            
            $producto->foto = substr($pathi, stripos($pathi, "/")+1);
            $change=TRUE;

        } else
        {
            $producto->foto = "my_files/productos/no.png";
            $change=TRUE;

        }
        if ($change==TRUE) {
            $producto->update();

        }

        return response()->json([ 'message' => 'Successfully createdr!'], 201);

    }

    public function actualizar(Request $request, $id)
    {
        
        // buscar el producto por id o no se si por codigo
        $user = Auth::user();
        $empresa= $user->empresa;
        $producto = Producto::find($id);

        // un if x si no se encuentra
        /*if($producto){
            return response()->json(['error' => $request], 404);
        }*/

        //nuevos datos
        /*
         $producto->update([
            'codigo' => "1",
            'precio' => $request->precio,
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'cantidad_disponible' => $request->cantidad_disponible,
            'cantidad_inventario' => $request->cantidad_disponible,
            'categoria_id' => $request->categoria,
            'empresa_id' => $empresa->id,
        ]);*/

        $producto->codigo = "1";
        $producto->precio = $request->precio;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->descripcion = $request->descripcion;
        $producto->cantidad_disponible = $request->cantidad_disponible;
        $producto->cantidad_inventario = $request->cantidad_disponible;
        $producto->categoria_id = $request->categoria;
        $producto->empresa_id = $empresa->id;
        $change=false;
        if ($request->hasFile('foto'))
        {
            if ($producto->foto == 'my_files/productos/no.png') {

            }else {
                    $ruta = "storage/$producto->foto";
                    unlink($ruta);
            }
            
            $user = Auth::user();
            $fileName=$request->file('foto')->getClientOriginalName();
            $extFile=substr($fileName, strripos($fileName, "."));
            $info_foto=
            $pathi = $request->file('foto')->storeAs('public','my_files/productos/'.$user->id.'/img_'. $producto->id.".png");
            //$pathi = $request->file('foto')->storeAs('user/123/img_123_img'.$extFile,'my_files');
            
            $producto->foto = substr($pathi, stripos($pathi, "/")+1);
            $change=TRUE;

        } else
        {
            $change=TRUE;

        }
        if ($change==TRUE) {
            $producto->update();

        }

        return response()->json([ 'message' => 'Successfully createdr!'], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //encontrar por id
        $producto = Producto::find($id);
        $favorito = Favorito::where('producto_id', $producto->id)->delete();
        if ($producto->foto == 'my_files/productos/no.png') {

        }else {
                $ruta = "storage/$producto->foto";
                unlink($ruta);
        }

        if(!$producto){
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        // eliminamos el producto
        $producto->delete();

        return response()->json(['message'=>'Producto eliminado'], 200);
    }


    public function getProductosCategoria($id)
    {
        $productos= Producto::where("categoria_id",$id)->where('cantidad_disponible', '>', 0)->get();
        foreach($productos as $producto){
            $empresa = Empresa::find($producto->empresa_id);
            $producto->nombre_empresa = $empresa->nombre_empresa;
        }
        return response()->json(['Producto' => $productos],200);
    }
}
