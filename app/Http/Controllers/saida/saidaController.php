<?php

namespace App\Http\Controllers\saida;

use App\Http\Controllers\Controller;
use App\Models\movimento;
use Illuminate\Http\Request;
use Saida;

class saidaController extends Controller
{


    public function listAll(Request $request ){
        $filtros = [];

        $filtroDtInicial  = ($request->get('dtInicial'))? $request->get('dtInicial') : session('filtroDtInicial');
        session()->put('filtroDtInicial', $filtroDtInicial);
        $filtroDtFinal  = ($request->get('dtFinal'))? $request->get('dtFinal') : session('filtroDtFinal');
        session()->put('filtroDtFinal', $filtroDtFinal);


        if($filtroDtFinal){
            $filtros[]=['movimento.data','>=',$filtroDtInicial];
            $filtros[]=['movimento.data','<=',$filtroDtFinal];
        }

        $saidas = movimento::leftjoin('pessoa','pessoa.id','movimento.pessoa')
                                ->leftjoin('produto','produto.id','movimento.produto')
                                ->where($filtros)
                                ->orderBy('data')
                                ->get(
                                    'movimento.id'
                                    ,'movimento.data'
                                    ,'movimento.pessoa'
                                    ,'pessoa.nome'
                                    ,'movimento.doc'
                                    ,'produto.id'
                                    ,'produto.produto'
                                    ,'movimento.movimento'
                                );

        return view('saida.listAll' , compact('saidas'));
    }

    public function formAdd()
    {
        return view('saida.add');
    }
    public function strore(Request $request)
    {
        try{
            $saida = new saida([
                "id"            => $request->id
                ,"data"         => $request->data
                ,"pessoa"       => $request->pessoa
                ,"doc"          => $request->doc
                ,"produto"      => $request->produto
                ,"movimento"    => $request->movimento
                ]);
            $saida->save();
        }catch(\Exception $e){
            return response()->json($saida);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $saida = movimento::where('id','=',$id)->first();

        return view('saida.edit' , compact('saida'));
    }

    public function edit($id, Request $request)
    {

        try{
            $saida = saida::find($id);
            $saida->data        = $request->data;
            $saida->pessoa      = $request->pessoa;
            $saida->doc         = $request->doc;
            $saida->produto     = $request->produto;
            $saida->movimento   = $request->movimento;
            $saida->save();
        }catch(\Exception $e){
            return response()->json($saida);
        }
        return response()->json('success');
    }
    //
}