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

Route::middleware(['auth:sanctum', 'verified'])->get('/',[AuthController::class, 'dashboard'])->name('home');

Route::get('/login',[AuthController::class, 'showLoginForm'])->name('dashboard.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('dashboard.logout');
Route::post('/login/do', [AuthController::class, 'login'])->name('dashboard.login.do');
Route::post('/change-color', [AuthController::class, 'changeColor'])->name('dashboard.color');

Route::get('/obras/criar', [ObraController::class, 'create'])->name('obras.criar');
Route::get('/obras/', [ObraController::class, 'show'])->name('obras.show');
Route::get('/obras/ativas', [ObraController::class, 'gerenciar'])->name('obras.ativas');
Route::get('/obras/{obra}/edit', [ObraController::class, 'edit'])->name('obras.edit');
Route::get('/obras/{obra}/faltas', [ObraController::class, 'faltas'])->name('obras.faltas');
Route::get('/obras/relatorio/{obra}', [ObraController::class, 'relatorio'])->name('obras.relatorio');
Route::post('/obras/store', [ObraController::class, 'store'])->name('obras.store');
Route::put('/obras/update/{obra}', [ObraController::class, 'update'])->name('obras.update');
Route::put('/obras/{obra}/faltas/registar', [ObraController::class, 'registrarFaltas'])->name('obras.registrarFaltas');
Route::put('/obras/concluir/{obra}', [ObraController::class, 'concluir'])->name('obras.concluir');
Route::delete('/obras/delete/{obra}', [ObraController::class, 'destroy'])->name('obras.delete');

Route::get('/funcionarios/criar', [FuncionarioController::class, 'create'])->name('funcionarios.criar');
Route::get('/funcionarios/', [FuncionarioController::class, 'show'])->name('funcionarios.show');
Route::get('/funcionarios/{funcionario}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
Route::get('/funcionarios/salario/{funcionario}', [FuncionarioController::class, 'salario'])->name('funcionarios.salario');
Route::post('/funcionarios/store', [FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::put('/funcionarios/update/{funcionario}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::delete('/funcionarios/delete/{funcionario}', [FuncionarioController::class, 'destroy'])->name('funcionarios.delete');

Route::get('/clientes/criar', [ClienteController::class, 'create'])->name('clientes.criar');
Route::get('/clientes/', [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
Route::put('/clientes/update/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/delete/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.delete');
