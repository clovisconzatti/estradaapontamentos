<?php

namespace App\Http\Controllers\movimento;

use App\Http\Controllers\Controller;
use App\Models\movimento;
use App\Models\pessoa;
use App\Models\produto;
use Illuminate\Http\Request;

class movimentoController extends Controller
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

        $movimentos = movimento::leftjoin('pessoa','pessoa.id','movimento.pessoa')
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

        return view('movimento.listAll' , compact('movimentos'));
    }

    public function formAdd()
    {
        return view('movimento.add');
    }
    public function strore(Request $request)
    {
        try{
            $movimento = new movimento([
                "id"            => $request->id
                ,"data"         => $request->data
                ,"pessoa"       => $request->pessoa
                ,"doc"          => $request->doc
                ,"produto"      => $request->produto
                ,"movimento"    => $request->movimento
                ]);
            $movimento->save();
        }catch(\Exception $e){
            return response()->json($movimento);
        }
        return response()->json('success');
    }

    public function formEdit($id)
    {
        $movimento = movimento::where('id','=',$id)->first();

        return view('movimento.edit' , compact('movimento'));
    }

    public function edit($id, Request $request)
    {

        try{
            $movimento = movimento::find($id);
            $movimento->data        = $request->data;
            $movimento->pessoa      = $request->pessoa;
            $movimento->doc         = $request->doc;
            $movimento->produto     = $request->produto;
            $movimento->movimento   = $request->movimento;
            $movimento->save();
        }catch(\Exception $e){
            return response()->json($movimento);
        }
        return response()->json('success');
    }
    //
}