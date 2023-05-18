<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\user_etapa;
use App\Models\etapas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class usuarioController extends Controller
{
    public function updateSenha(Request $request)
    {
        $usuario = Auth::user(); // resgata o usuario

        $usuario_id = $usuario->id;

        $error = 'success';
        try{
            $usuario = User::find($usuario_id);
            $usuario->password = bcrypt($request->novaSenha);
            $usuario->save();
        }catch(\Exception $e){
            $error = $e;
        }
        return response()->json($error);
    }

}
