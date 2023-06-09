<?php

namespace App\Http\Controllers\saldo;

use App\Http\Controllers\Controller;
use App\Models\movimento;
use App\Models\produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mpdf\Mpdf as PDF;


class saldoController extends Controller
{
    public function listAll(Request $request ){
        $filtros = [];

        $filtroDtInicial  = ($request->get('dtInicial'))? $request->get('dtInicial') : session('filtroDtInicial');
        session()->put('filtroDtInicial', $filtroDtInicial);
        $filtroDtFinal  = ($request->get('dtFinal'))? $request->get('dtFinal') : session('filtroDtFinal');
        session()->put('filtroDtFinal', $filtroDtFinal);
        $filtroprodutoid  = $request->get('produto');
        session()->put('filtroprodutoid', $filtroprodutoid);



        if($filtroDtFinal){
            $filtros[]=['movimento.data','>=',$filtroDtInicial];
            $filtros[]=['movimento.data','<=',$filtroDtFinal];
        }

        if($filtroprodutoid){
            $filtros[]=['movimento.produto','=',$filtroprodutoid];
        }
        // dd($filtros);
        $produtos = produto::get();
        $saldo = movimento::leftjoin('produto','produto.id','movimento.produto')
                                ->where($filtros)
                                ->orderBy('produto.produto')
                                ->groupBy('produto.codfocco','produto.produto')
                                ->get([
                                    'produto.codfocco'
                                    ,'produto.produto'
                                    ,DB::raw("sum(case when movimento.movimento ='S' then -movimento.quantidade else movimento.quantidade end) as quantidade")
                                ]);
        // dd($filtros,$saldo);
        return view('saldo.listAll' , compact('saldo','produtos','filtroDtInicial','filtroDtFinal','filtroprodutoid'));
    }
    public function pdf(Request $request)
    {
        $filtros = [];

        $filtroDtInicial  = ($request->get('dtInicial'))? $request->get('dtInicial') : session('filtroDtInicial');
        session()->put('filtroDtInicial', $filtroDtInicial);
        $filtroDtFinal  = ($request->get('dtFinal'))? $request->get('dtFinal') : session('filtroDtFinal');
        session()->put('filtroDtFinal', $filtroDtFinal);
        $filtroprodutoid  = $request->get('produto');
        session()->put('filtroprodutoid', $filtroprodutoid);



        if($filtroDtFinal){
            $filtros[]=['movimento.data','>=',$filtroDtInicial];
            $filtros[]=['movimento.data','<=',$filtroDtFinal];
        }

        if($filtroprodutoid){
            $filtros[]=['movimento.produto','=',$filtroprodutoid];
        }
        // dd($filtros);
        $produtos = produto::get();
        $saldo = movimento::leftjoin('produto','produto.id','movimento.produto')
                                ->where($filtros)
                                ->orderBy('produto.produto')
                                ->groupBy('produto.produto')
                                ->get([
                                    'produto.codfocco'
                                    ,'produto.produto'
                                    ,DB::raw("sum(case when movimento.movimento ='S' then -movimento.quantidade else movimento.quantidade end) as quantidade")
                                ]);
        // dd($filtros,$saldo);

        /******** configurações pdf *************************/

        $fileName = 'Estoque.pdf';
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_top'    => intval(10),
            'margin_right'  => intval(5),
            'margin_bottom' => intval(10),
            'margin_left'   => intval(5),
            'margin_header' => intval(0),
            'margin_footer' => intval(0)
            ]);
        $html = view('pdf.pdf', compact('saldo'));
        $html = $html->render();
        $mpdf->AddPage('P');
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }
}
