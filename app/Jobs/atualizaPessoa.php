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
        $this->cliente();
    }

    public function cliente()
    {
        $pessoa = pessoa::where('cliente','Sim')->get(['codfocco']);
        dd($pessoa);
        $cliente = foccoPessoa::get();
        $fornecedor = foccoFornecedor::get();
    }
}
