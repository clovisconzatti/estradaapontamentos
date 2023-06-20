<?php

namespace App\Http\Controllers\produto;

use App\Http\Controllers\Controller;
use App\Models\produto;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class produtoController extends Controller
{

    public function listAll(Request $request ){
        $filtros = [];

        $produto  = ($request->get('produto'))? $request->get('produto') : session('produto');
        session()->put('produto', $produto);
        if($produto){
            $filtros[]=['produto.produto','like','%'.$produto.'%'];
        }

        $produtos = produto::where($filtros)->orderBy('produto')->paginate(7);

        return view('produto.listAll' , compact('produtos'));
    }

    public function formAdd()
    {
        return view('produto.add');
    }
    public function strore(Request $request)
    {
        try{
            $produto = new produto([
                "id"                => $request->id
                ,"codfocco"         => $request->codfocco
                ,"produto"          => $request->produto
                ]);
            $produto->save();
        }catch(\Exception $e){
            return response()->json($produto);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $produto = produto::where('id','=',$id)->first();

        return view('produto.edit' , compact('produto'));
    }

    public function edit($id, Request $request)
    {

        try{
            $produto = produto::find($id);
            $produto->codfocco   = $request->codfocco;
            $produto->produto    = $request->produto;
            $produto->save();
        }catch(\Exception $e){
            return response()->json($produto);
        }
        return response()->json('success');
    }
    //
}
