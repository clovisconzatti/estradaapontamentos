<?php

namespace App\Http\Controllers\saida;

use App\Http\Controllers\Controller;
use App\Models\movimento;
use App\Models\pessoa;
use App\Models\produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $clientes = pessoa::where('cliente','Sim')->get();
        $produtos = produto::get();
        $saidas = movimento::leftjoin('pessoa','pessoa.id','movimento.pessoa')
                                ->leftjoin('produto','produto.id','movimento.produto')
                                ->leftJoin('users','users.id','movimento.user_id')
                                ->leftJoin('users as usures_alter','usures_alter.id','movimento.user_alteracao_id')
                                ->where($filtros)
                                ->where('movimento.movimento','=','S')
                                ->orderBy('data','desc')
                                ->get([
                                    'movimento.id'
                                    ,'movimento.data'
                                    ,'movimento.pessoa'
                                    ,'pessoa.nome'
                                    ,'movimento.doc'
                                    ,'produto.codfocco'
                                    ,'produto.produto'
                                    ,'movimento.movimento'
                                    ,'movimento.quantidade'
                                    ,'movimento.obs'
                                    ,'movimento.chassi'
                                    ,'movimento.user_id'
                                    ,'users.name'
                                    ,DB::raw("usures_alter.name as users_alter")

                                ]);

        return view('saida.listAll' , compact('saidas','clientes','produtos','filtroDtInicial','filtroDtFinal'));
    }

    public function formAdd()
    {
        $clientes = pessoa::where('cliente','Sim')->orderBy('nome')->get();
        $produtos = produto::orderBy('produto')->get();

        return view('saida.add', compact('clientes','produtos'));
    }

    public function strore(Request $request)
    {
        try{
            $saida = new movimento([
                "user_id"        => Auth::user()->id
                ,"id"            => $request->id
                ,"data"         => $request->data
                ,"pessoa"       => $request->pessoa
                ,"doc"          => $request->doc
                ,"codfocco"     => $request->codfocco
                ,"produto"      => $request->produto
                ,"movimento"    => $request->movimento
                ,"quantidade"   => $request->quantidade
                ,"obs"          => $request->obs
                ,"chassi"       => $request->chassi
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
        $clientes = pessoa::where('cliente','Sim')->get();
        $produtos = produto::get();
        $user = user::get();
        return view('saida.edit' , compact('saida','clientes','produtos','user'));
    }

    public function edit($id, Request $request)
    {
        try{
            $saida = movimento::find($id);
            $saida->data        = $request->data;
            $saida->pessoa      = $request->pessoa;
            $saida->doc         = $request->doc;
            $saida->produto     = $request->produto;
            $saida->movimento   = $request->movimento;
            $saida->quantidade  = $request->quantidade;
            $saida->obs         = $request->obs;
            $saida->chassi      = $request->chassi;
            $saida->user_alteracao_id = Auth::user()->id;
            $saida->save();
        }catch(\Exception $e){
            return response()->json($e);
        }
        return response()->json('success');
    }
    //
}
