<?php

namespace App\Http\Controllers\movimento;

use App\Http\Controllers\Controller;
use App\Models\movimento;
use App\Models\pessoa;
use App\Models\produto;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class movimentoController extends Controller
{

    public function listAll(Request $request ){
        $filtros=[];

        $filtroDtInicial  = ($request->get('dtInicial'))? $request->get('dtInicial') : session('filtroDtInicial');
        session()->put('filtroDtInicial', $filtroDtInicial);
        $filtroDtFinal  = ($request->get('dtFinal'))? $request->get('dtFinal') : session('filtroDtFinal');
        session()->put('filtroDtFinal', $filtroDtFinal);
        $filtrofornecedor  = ($request->get('pessoa'))? $request->get('pessoa') : session('filtrofornecedor');
        session()->put('filtrofornecedor', $filtrofornecedor);
        $filtroproduto  = ($request->get('produto'))? $request->get('produto') : session('filtroproduto');
        session()->put('filtroproduto', $filtroproduto);

        if($filtrofornecedor){
            $filtros[]=['pessoa.nome','like','%'.$filtrofornecedor.'%'];
        }

        if($filtroproduto){
            $filtros[]=['produto.produto','like','%'.$filtroproduto.'%'];
        }

        if($filtroDtFinal){
            $filtros[]=['movimento.data','>=',$filtroDtInicial];
            $filtros[]=['movimento.data','<=',$filtroDtFinal];
        }
        // dd($filtros);
        $fornecedores = pessoa::where('fornecedor','Sim')->get();
        $produtos = produto::get();
        $movimentos = movimento::leftjoin('pessoa','pessoa.id','movimento.pessoa')
                                ->leftjoin('produto','produto.id','movimento.produto')
                                ->leftJoin('users','users.id','movimento.user_id')
                                ->leftJoin('users as usures_alter','usures_alter.id','movimento.user_alteracao_id')
                                ->where($filtros)
                                ->where('movimento.movimento','=','E')
                                ->where('movimento.ativo','=','Sim')
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
                                    ,'movimento.user_id'
                                    ,'users.name'
                                    ,DB::raw("usures_alter.name as users_alter")
                                ]);
        //  dd($movimentos);
        return view('movimento.listAll' , compact('movimentos','fornecedores','produtos','filtrofornecedor','filtroproduto'));
    }

    public function formAdd()
    {
        $fornecedores = pessoa::where('fornecedor','Sim')->orderBy('nome')->get();
        $produtos = produto::orderBy('produto')->get();

        return view('movimento.add', compact('fornecedores','produtos'));
    }
    public function strore(Request $request)
    {
        try{
            $movimento = new movimento([
                "user_id"       => Auth::user()->id
                ,"id"           => $request->id
                ,"data"         => $request->data
                ,"pessoa"       => $request->pessoa
                ,"doc"          => $request->doc
                ,"codfocco"     => $request->codfocco
                ,"produto"      => $request->produto
                ,"movimento"    => $request->movimento
                ,"quantidade"   => $request->quantidade
                ,"obs"          => $request->obs
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
        $fornecedores = pessoa::where('fornecedor','Sim')->orderBy('nome')->get();
        $produtos = produto::orderBy('produto')->get();
        $user = user::orderBy('name')->get();
        return view('movimento.edit' , compact('movimento','fornecedores','produtos','user'));
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
            $movimento->quantidade  = $request->quantidade;
            $movimento->obs         = $request->obs;
            $movimento->user_alteracao_id = Auth::user()->id;
            $movimento->save();
        }catch(\Exception $e){
            return response()->json($movimento);
        }
        return response()->json('success');
    }

    public function destroy(movimento $movimento)
    {
        $movimento->user_delete_id=Auth::user()->id;
        $movimento->save();
        $movimento->delete();
        return redirect()->route('movimento.listAll');
    }
    //
}
