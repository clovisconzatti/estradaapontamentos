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
            [
                'ordem'         =>'02.001'
                , 'descricao'   =>'Entradas'
                , 'tipo'        =>'Link'
                , 'rota'        =>'movimento.listAll'
                , 'icone'       =>'fas fa-cubes'
            ],
            [
                'ordem'         =>'02.002'
                , 'descricao'   =>'Saidas'
                , 'tipo'        =>'Link'
                , 'rota'        =>'saida.listAll'
                , 'icone'       =>'fas fa-cart-arrow-down'
            ],
            [
                'ordem'         =>'03.000'
                , 'descricao'   =>'Saldo'
                , 'tipo'        =>'Título'
                , 'rota'        =>''
                , 'icone'       =>''
            ],
            [
                'ordem'         =>'03.001'
                , 'descricao'   =>'Estoque'
                , 'tipo'        =>'Link'
                , 'rota'        =>'saldo.listAll'
                , 'icone'       =>'far fa-clipboard'
            ],

        ];
        menu::insert($menus);
    }

}
