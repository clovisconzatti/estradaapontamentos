<?php

namespace Database\Seeders;

use App\Models\menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        menu::truncate();
        $menus=[
            [
                'ordem'         =>'01.000'
                , 'descricao'   =>'Cadastro'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],
            [
                'ordem'         =>'01.001'
                , 'descricao'   =>'Cliente/Fornecedor'
                , 'tipo'        =>'Link'
                , 'rota'        =>'pessoa.listAll'
                , 'icone'       =>'far fa-address-book'
            ],
            [
                'ordem'         =>'01.002'
                , 'descricao'   =>'Produto'
                , 'tipo'        =>'Link'
                , 'rota'        =>'produto.listAll'
                , 'icone'       =>'far fa-clipboard'
            ],

            [
                'ordem'         =>'02.000'
                , 'descricao'   =>'Movimento'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],
        ];
        menu::insert($menus);
    }

}
