<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use carbon\carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function users(Request $request)
    {
        $user = $request->user();
        if($user->rol_id == 1 ){
            $users = User::all();
            return response()->json(['Users' => $users]);
        }

        return response()->json(['NO TIENES ACCESO']);

    }

    public function delete(Request $request, $id)
    {
        $user = $request->user();
        if ($user->rol_id == 1) {
            $userdb = User::find($id);
            if(!$userdb){
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
            // eliminamos el producto
            $userdb->delete();
    
            return response()->json(['message'=>'Usuario eliminado'], 200);
        }
        if ($user->rol_id !=1) {
            $userdb = User::find($id);
            if ($user->id == $userdb->id) {
                $userdb->delete();
                return response()->json(['message' => 'Usuario eliminado'], 200);
            }
            return response()->json(['error' => 'No puedes hacer eso'], 404);
        }
    }




    /**
     * Registro de usuario
     */


    public function signUp(Request $request)
    {
        $request->validate([
            'cedula' => 'required|numeric|unique:users',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|numeric',
            'password' => 'required|string'


        ]);

        $user=User::create([
            'rol_id' => "3",
            'estado' => "activo",
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'fecha_nacimiento' => Carbon::parse($request->fecha_nacimiento)->format('Y-m-d'),
            'telefono' => $request->telefono,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function signUpEmpresario(Request $request)
    {

        //return response()->json($request);
        $request->validate([
            'cedula' => 'required|unique:users',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|string|unique:users',
            'fecha_nacimiento' => 'required',
            'telefono' => 'required',
            'password' => 'required|string',
            'nit_empresa' => 'required|unique:empresas',
            'direccion_empresa' => 'required|string',
            'nombre_empresa' => 'required|string',
            'telefono_empresa' => 'required|unique:empresas',
            'email_empresa' => 'required|string|unique:empresas',
        ]);

        $user=User::create([
            'rol_id' => "2",
            'estado' => "pendiente",
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'fecha_nacimiento' => Carbon::parse($request->fecha_nacimiento)->format('Y-m-d'),
            'telefono' => $request->telefono,
            'password' => bcrypt($request->password)
        ]);
 try {
        Empresa::create([
            'estado' => "pendiente",
            'nit_empresa' => $request->nit_empresa,
            'direccion_empresa' => $request->direccion_empresa,
            'nombre_empresa' => $request->nombre_empresa,
            'telefono_empresa' => $request->telefono_empresa,
            'email_empresa' => $request->email_empresa,
            'user_id' => $user->id,
        ]);
        $change=false;
        if ($request->hasFile('foto'))
        {
            $fileName=$request->file('foto')->getClientOriginalName();
            $extFile=substr($fileName, strripos($fileName, "."));
            $info_foto=
            $pathi = $request->file('foto')->storeAs('public','my_files/user/'.$user->id.'/img'. $user->id."_img.png");
            
            $producto->foto = substr($pathi, stripos($pathi, "/")+1);
            $user->foto = $pathi;
            $change=TRUE;
        } else {
            $user->foto = "my_files/productos/no.png";
            $change=TRUE;
        }
        
        if ($change==TRUE) {
            $user->save();

        }
    } catch (Throwable $e) {
        $user->delete();
        return response()->json([
            'message' => 'Error'
        ], 500);
    }

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        if($user->rol->id == 2){
            $empresa = Empresa::where('user_id', $user->id)->first();
            return response()->json([
                'user' => $user,
                'empresa' => $empresa,
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
            ]);
        }

        return response()->json([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }
  
    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        $user = $request->user();
        $user->rol;
        return response()->json($user);
    }
    
    public function update (Request $request) {

        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $user->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);
        return response()->json(['message' => 'Usuario actualizado', 'Usuario'=>$user]);
    }

    public function autologin (){
        $user = Auth::user();
    
        if($user->rol->id == 2){
            $empresa = Empresa::where('user_id', $user->id)->first();
            return response()->json([
                'user' => $user,
                'empresa' => $empresa,
            ]);
        }

        return response()->json([
            'user' => $user,
        ]);

    }

}
