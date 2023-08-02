<?php

use App\Http\Controllers\Auth\usuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\pessoa\pessoaController;
use App\Http\Controllers\produto\produtoController;
use App\Http\Controllers\movimento\movimentoController;
use App\Http\Controllers\saida\saidaController;
use App\Http\Controllers\saldo\saldoController;
use App\Http\Controllers\cancelamento\cancelamentoController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('auth/login');
});


Route::group(['middleware' => ['auth']], function () {

    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/public', [HomeController::class, 'index']);

    /********************************** menu ***************************************************************/
    Route::group(['namespace' => 'menu'], function () {
        Route::get('menu',[MenuController::class,'listAllmenu'])->name('menu.listAll');
        Route::get('menu/novo',[MenuController::class,'formAddmenu'])->name('menu.formAddmenu');
        Route::get('menu/editar/{menu}',[MenuController::class,'formEditmenu'])->name('menu.formEditmenu');
        Route::post('menu/store',[MenuController::class,'stroremenu'])->name('menu.store');
        Route::patch('menu/edit/{menu}',[MenuController::class,'edit'])->name('menu.edit');
        Route::delete('menu/destroy/{menu}',[MenuController::class,'destroy'])->name('menu.destroy');

        Route::get('menu/menuUsuario',[MenuController::class,'menuUsuario'])->name('menu.menuUsuario');
        Route::post('menu/disponivel',[MenuController::class,'disponivel'])->name('menu.disponivel');
        Route::post('menu/menuLiberado',[MenuController::class,'menuLiberado'])->name('menu.menuLiberado');

        Route::post('menu/addMenuUsuario',[MenuController::class,'addMenuUsuario'])->name('menu.addMenuUsuario');
        Route::post('menu/removeMenuUsuario',[MenuController::class,'removeMenuUsuario'])->name('menu.removeMenuUsuario');


    });

        /********************************** usuario ***************************************************************/
        Route::group(['namespace' => 'usuario'], function () {
            Route::post('usuario/updateSenha',[usuarioController::class,'updateSenha'])->name('usuario.updateSenha');
        });

        /********************************** pessoa ***************************************************************/
    Route::group(['namespace' => 'pessoa'], function () {
        Route::get('pessoa',[pessoaController::class,'listAll'])->name('pessoa.listAll');
        Route::get('pessoa/novo',[pessoaController::class,'formAdd'])->name('pessoa.formAdd');
        Route::get('pessoa/editar/{pessoa}',[pessoaController::class,'formEdit'])->name('pessoa.formEdit');
        Route::post('pessoa/store',[pessoaController::class,'strore'])->name('pessoa.store');
        Route::patch('pessoa/edit/{pessoa}',[pessoaController::class,'edit'])->name('pessoa.edit');
        Route::delete('pessoa/destroy/{pessoa}',[pessoaController::class,'destroy'])->name('pessoa.destroy');
    });
    /********************************** produto ***************************************************************/
        Route::group(['namespace' => 'produto'], function () {
        Route::get('produto',[produtoController::class,'listAll'])->name('produto.listAll');
        Route::get('produto/novo',[produtoController::class,'formAdd'])->name('produto.formAdd');
        Route::get('produto/editar/{produto}',[produtoController::class,'formEdit'])->name('produto.formEdit');
        Route::post('produto/store',[produtoController::class,'strore'])->name('produto.store');
        Route::patch('produto/edit/{produto}',[produtoController::class,'edit'])->name('produto.edit');
        Route::delete('produto/destroy/{produto}',[produtoController::class,'destroy'])->name('produto.destroy');
    });

   /********************************** entrada ***************************************************************/
    Route::group(['namespace' => 'movimento'], function () {
        Route::get('movimento',[movimentoController::class,'listAll'])->name('movimento.listAll');
        Route::get('movimento/novo',[movimentoController::class,'formAdd'])->name('movimento.formAdd');
        Route::get('movimento/editar/{movimento}',[movimentoController::class,'formEdit'])->name('movimento.formEdit');
        Route::post('movimento/store',[movimentoController::class,'strore'])->name('movimento.store');
        Route::patch('movimento/edit/{movimento}',[movimentoController::class,'edit'])->name('movimento.edit');
        Route::delete('movimento/destroy/{movimento}',[movimentoController::class,'destroy'])->name('movimento.destroy');

    });
    /********************************** saida ***************************************************************/
    Route::group(['namespace' => 'saida'], function () {
        Route::get('saida',[saidaController::class,'listAll'])->name('saida.listAll');
        Route::get('saida/novo',[saidaController::class,'formAdd'])->name('saida.formAdd');
        Route::get('saida/editar/{saida}',[saidaController::class,'formEdit'])->name('saida.formEdit');
        Route::post('saida/store',[saidaController::class,'strore'])->name('saida.store');
        Route::patch('saida/edit/{saida}',[saidaController::class,'edit'])->name('saida.edit');
        Route::delete('saida/destroy/{saida}',[saidaController::class,'destroy'])->name('saida.destroy');

    });
    /********************************** saldo ***************************************************************/
    Route::group(['namespace' => 'saldo'], function () {
        Route::get('saldo',[saldoController::class,'listAll'])->name('saldo.listAll');
        Route::get('saldo/pdf',[saldoController::class,'pdf'])->name('saldo.pdf');

        Route::get('saldo/teste',[saldoController::class,'teste'])->name('saldo.teste');
    });


});
