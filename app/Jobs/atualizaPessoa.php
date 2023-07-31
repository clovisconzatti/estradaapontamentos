<?php

namespace App\Jobs;

use App\Models\foccoFornecedor;
use App\Models\foccoPessoa;
use App\Models\pessoa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class atualizaPessoa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {
        //
    }


    public function handle()
    {
        $codCli = [];
        $codFor = [];

        $pessoa = pessoa::where('cliente','Sim')->get(['codfocco']);
        foreach( $pessoa as $item )
        {
            $codCli[]=$item->codfocco;
        }
        $cliente = foccoPessoa::whereNotIn('COD_CLI',$codCli)->get();
        foreach($cliente as  $cli)
        {
            $NewPessoa = new pessoa([
                'codfocco'      =>$cli->COD_CLI
                , 'nome'        =>$cli->DESCRICAO
                , 'cliente'     =>'Sim'
                , 'fornecedor'  =>'Não'
            ]);
            $NewPessoa->save();
        }

        $pessoa = pessoa::where('fornecedor','Sim')->get(['codfocco']);
        dd($pessoa);
        foreach( $pessoa as $item )
        {
            $codFor[] =$item->codfocco;
        }
        dd($codFor);
        $fornecedor = foccoFornecedor::whereNotIn('COD_FOR',$codFor)->get();
        foreach($fornecedor as  $cli)
        {
            $NewPessoa = new pessoa([
                'codfocco'      =>$cli->COD_FOR
                , 'nome'        =>$cli->DESCRICAO
                , 'cliente'     =>'Não'
                , 'fornecedor'  =>'Sim'
            ]);
            $NewPessoa->save();
        }
    }

}
