<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\ObraController;
use \App\Http\Controllers\FuncionarioController;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\FaseController;
use \App\Http\Controllers\LojaController;

Route::middleware(['auth:sanctum', 'verified'])->get('/',[AuthController::class, 'dashboard'])->name('home');

Route::get('/login',[AuthController::class, 'showLoginForm'])->name('dashboard.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('dashboard.logout');
Route::post('/login/do', [AuthController::class, 'login'])->name('dashboard.login.do');
Route::get('/cadastrar',[AuthController::class, 'showCadastroForm'])->name('dashboard.cadastro');
Route::post('/cadastrar/do',[AuthController::class, 'cadastro'])->name('dashboard.cadastro.do');

Route::group(['prefix'=>'obras', 'middleware'=>'auth'], function (){
    Route::get('/criar', [ObraController::class, 'create'])->name('obras.criar');
    Route::get('/', [ObraController::class, 'show'])->name('obras.show');
    Route::get('/ativas', [ObraController::class, 'gerenciar'])->name('obras.ativas');
    Route::get('/{obra}/edit', [ObraController::class, 'edit'])->name('obras.edit');
    Route::get('/{obra}/faltas', [ObraController::class, 'faltas'])->name('obras.faltas');
    Route::get('/relatorio/{obra}', [ObraController::class, 'relatorio'])->name('obras.relatorio');
    Route::post('/store', [ObraController::class, 'store'])->name('obras.store');
    Route::post('/datatable', [ObraController::class, 'datatable'])->name('obras.datatable');
    Route::post('/datatable/ativas', [ObraController::class, 'datatableAtivas'])->name('obras.datatableAtivas');
    Route::post('/datarelatorio/{obra}', [ObraController::class, 'datatableRelatorio'])->name('obras.dataRelatorio');
    Route::post('/datarelatoriofuncionario/{obra}', [ObraController::class, 'datatableRelatorioFuncionario'])->name('obras.dataRelatorioFuncionario');
    Route::put('/update/{obra}', [ObraController::class, 'update'])->name('obras.update');
    Route::put('/{obra}/faltas/registar', [ObraController::class, 'registrarFaltas'])->name('obras.registrarFaltas');
    Route::put('/concluir/{obra}', [ObraController::class, 'concluir'])->name('obras.concluir');
    Route::delete('/delete/{obra}', [ObraController::class, 'destroy'])->name('obras.delete');

});

Route::group(['prefix'=>'funcionarios', 'middleware'=>'auth'], function () {
    Route::get('/criar', [FuncionarioController::class, 'create'])->name('funcionarios.criar');
    Route::get('/', [FuncionarioController::class, 'show'])->name('funcionarios.show');
    Route::get('/{funcionario}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
    Route::get('/salario/{funcionario}', [FuncionarioController::class, 'salario'])->name('funcionarios.salario');
    Route::post('/store', [FuncionarioController::class, 'store'])->name('funcionarios.store');
    Route::post('/datatable', [FuncionarioController::class, 'datatable'])->name('funcionarios.datatable');
    Route::put('/update/{funcionario}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
    Route::post('/pagar/{obra}', [FuncionarioController::class, 'pagar'])->name('funcionarios.pagar');
    Route::delete('/delete/{funcionario}', [FuncionarioController::class, 'destroy'])->name('funcionarios.delete');
});

Route::group(['prefix'=>'clientes', 'middleware'=>'auth'], function () {
    Route::get('/criar', [ClienteController::class, 'create'])->name('clientes.criar');
    Route::get('/', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::post('/store', [ClienteController::class, 'store'])->name('clientes.store');
    Route::put('/update/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/delete/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.delete');
});
Route::group(['prefix'=>'lojas', 'middleware'=>'auth'], function () {
    Route::get('/', [LojaController::class, 'index'])->name('lojas.index');
    Route::get('/criar', [LojaController::class, 'create'])->name('lojas.criar');
    Route::get('/{loja}/edit', [LojaController::class, 'edit'])->name('lojas.edit');
    Route::post('/datatble', [LojaController::class, 'datatable'])->name('lojas.datatable');
    Route::post('/store', [LojaController::class, 'store'])->name('lojas.store');
    Route::put('/update/{loja}', [LojaController::class, 'update'])->name('lojas.update');
    Route::delete('/delete/{loja}', [LojaController::class, 'destroy'])->name('lojas.delete');
});
Route::group(['prefix'=>'fases', 'middleware'=>'auth'], function () {
    Route::get('/', [FaseController::class, 'index'])->name('fases.index');
    Route::get('/criar', [FaseController::class, 'create'])->name('fases.criar');
    Route::get('/edit/{fase}', [FaseController::class, 'edit'])->name('fases.edit');
    Route::post('/datatble', [FaseController::class, 'datatable'])->name('fases.datatable');
    Route::post('/store', [FaseController::class, 'store'])->name('fases.store');
    Route::put('/update/{fase}', [FaseController::class, 'update'])->name('fases.update');
    Route::delete('/delete/{fase}', [FaseController::class, 'destroy'])->name('fases.delete');
});


