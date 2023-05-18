<?php

namespace App\Http\Controllers\pessoa;

use App\Http\Controllers\Controller;
use App\Models\pessoa;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class pessoaController extends Controller
{

    public function listAll(Request $request ){
        $filtros = [];

        $pessoa  = ($request->get('pessoa'))? $request->get('pessoa') : session('pessoa');
        session()->put('pessoa', $pessoa);
        if($pessoa){
            $filtros[]=['pessoa.nome','like','%'.$pessoa.'%'];
        }

        $pessoas = pessoa::where($filtros)->orderBy('nome')->get();

        return view('pessoa.listAll' , compact('pessoas'));
    }

    public function formAdd()
    {
        return view('pessoa.add');
    }
    public function strore(Request $request)
    {
        try{
            $pessoa = new pessoa([
                "id"                => $request->id
                ,"codfocco"         => $request->codfocco
                ,"nome"             => $request->nome
                ,"cliente"          => $request->cliente
                ,"fornecedor"       => $request->fornecedor
                ]);
            $pessoa->save();
        }catch(\Exception $e){
            return response()->json($pessoa);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $pessoa = pessoa::where('id','=',$id)->first();

        return view('pessoa.edit' , compact('pessoa'));
    }

    public function edit($id, Request $request)
    {

        try{
            $pessoa = pessoa::find($id);
            $pessoa->codfocco   = $request->codfocco;
            $pessoa->nome       = $request->nome;
            $pessoa->cliente    = $request->cliente;
            $pessoa->fornecedor = $request->fornecedor;
            $pessoa->save();
        }catch(\Exception $e){
            return response()->json($pessoa);
        }
        return response()->json('success');
    }
    //
}
