<?php

namespace App\Jobs;

use App\Models\foccoFornecedor;
use App\Models\pessoa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class atualizaForencedor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {
        //
    }

    public function handle()
    {
        $codFor = [];
        $pessoa = pessoa::where('fornecedor','Sim')->get(['codfocco']);
        foreach( $pessoa as $item )
        {
            $codFor[] =$item->codfocco;
        }
        $fornecedor = foccoFornecedor::whereNotIn('COD_FOR',$codFor)->get();
        foreach($fornecedor as  $cli)
        {
            try{
                $NewPessoa = new pessoa([
                    'codfocco'      =>$cli->COD_FOR
                    , 'nome'        =>$cli->DESCRICAO
                    , 'cliente'     =>'Não'
                    , 'fornecedor'  =>'Sim'
                ]);
                $NewPessoa->save();
            }catch(\Exception $e){
                // dd($e);
            }

        }

    }
}
