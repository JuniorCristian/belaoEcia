<?php

namespace App\Http\Controllers;

use App\Models\Faltas_Obra;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() === true) {
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() === true) {
            return view('criar_funcionarios');
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() === true) {
            $funcionario = new Funcionario;
            $funcionario->nome = $request->nome;
            $funcionario->cpf = $request->cpf;
            $funcionario->telefone = $request->telefone;
            $funcionario->salario_dia = $request->salario_dia;
            $funcionario->funcao = $request->funcao;
            $funcionario->status_db = 1;
            if ($funcionario->save()) {
                return redirect()->route('funcionarios.show');
            }
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Funcionario $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::check() === true) {
            $funcionarios = Funcionario::all()->where('status_db', 1);
            return view('ver_funcionarios', [
                'funcionarios' => $funcionarios
            ]);
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Funcionario $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        if (Auth::check() === true) {
            return view('editar_funcionarios', ['funcionario'=>$funcionario]);
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Funcionario $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        if (Auth::check() === true) {
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Funcionario $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        if (Auth::check() === true) {
            $funcionario->status_db=0;
            if($funcionario->save()){
                return redirect()->route('funcionarios.show');
            }
        }
        return redirect()->route('dashboard.login');
    }

    public function salario(Funcionario $funcionario)
    {
        if (Auth::check() === true) {
            $salarios = $funcionario->faltas()->get();
            $obras = $funcionario->obras()->where('status_db', 1)->get();
            return view('salario_funcionario', ['obras'=>$obras, 'salarios'=>$salarios, 'funcionario'=>$funcionario]);
        }
        return redirect()->route('dashboard.login');
    }
}
