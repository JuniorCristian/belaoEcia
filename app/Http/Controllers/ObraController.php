<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Faltas_Obra;
use App\Models\Funcionario;
use App\Models\Funcionarios_Obra;
use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\String_;
use function PHPUnit\Framework\countOf;

class ObraController extends Controller
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
            $clientes = Cliente::all()->where('status_db', 1);
            $funcionarios = Funcionario::all()->where('status_db', 1);
            return view('criar_obras', [
                'clientes'=>$clientes,
                'funcionarios'=>$funcionarios
            ]);
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
            $funcionarios = Funcionario::all();
            foreach ($funcionarios as $key=>$func){
                if(isset($request['funcionario'.$func->id]) && $request['funcionario'.$func->id]){
                    $funcionario[$key] = $func->id;
                }
            }
            $obra = new Obra();
            $obra->orcamento = $request->orcamento;
            if (isset($request->has_orcamento_materias)) {
                $obra->orcamento_material = $request->orcamento_materias;
                $obra->has_orcamento_material = $request->has_orcamento_materias;
            } else {
                $obra->orcamento_material = 0;
                $obra->has_orcamento_material = false;
            }
            $obra->data_inicio_prevista = $request->data_inicio_prevista;
            $obra->data_final_prevista = $request->data_final_prevista;
            $obra->cep = $request->cep;
            $obra->rua = $request->rua;
            $obra->numero = $request->numero;
            $obra->complemento = $request->complemento;
            $obra->cep = $request->cep;
            $obra->bairro = $request->bairro;
            $obra->cidade = $request->cidade;
            $obra->uf = $request->uf;
            $obra->cliente = $request->cliente;
            $obra->status_db = 1;
            if($obra->save()){
                foreach ($funcionario as $id){
                    $funcionarios_obra = new Funcionarios_Obra();
                    $funcionarios_obra->funcionario=$id;
                    $funcionarios_obra->obra=$obra->id;
                    $funcionarios_obra->save();
                }
                return redirect()->route('obras.show');
            }
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Obra $obra
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::check() === true) {
            $obras = Obra::all()->where('status_db', 1);
            return view('ver_obras', [
                'obras' => $obras
            ]);
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Obra $obra
     * @return \Illuminate\Http\Response
     */
    public function edit(Obra $obra)
    {
        if (Auth::check() === true) {
            $obra->funcionario = $obra->funcionario()->get();
            $funcionarios = Funcionario::all()->where('status_db', 1);
            $clientes = Cliente::all()->where('status_db', 1);
            return view('editar_obras', [
                'obra'=>$obra,
                'funcionarios'=>$funcionarios,
                'clientes'=>$clientes
            ]);
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Obra $obra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obra $obra)
    {
        if (Auth::check() === true) {
            $funcionarios = Funcionario::all()->where('obra', $obra->id);
            foreach ($funcionarios as $funcionario){
                $funcionario->delete();
            }
            $funcionarios = Funcionario::all();
            foreach ($funcionarios as $key=>$func){
                if(isset($request['funcionario'.$func->id]) && $request['funcionario'.$func->id]){
                    $funcionario[$key] = $func->id;
                }
            }
            $obra->orcamento = $request->orcamento;
            if (isset($request->has_orcamento_materias)) {
                $obra->orcamento_material = $request->orcamento_materias;
                $obra->has_orcamento_material = $request->has_orcamento_materias;
            } else {
                $obra->orcamento_material = 0;
                $obra->has_orcamento_material = false;
            }
            $obra->data_inicio_prevista = $request->data_inicio_prevista;
            $obra->data_final_prevista = $request->data_final_prevista;
            $obra->data_inicio = $request->data_inicio;
            $obra->data_final = $request->data_final;
            $obra->cep = $request->cep;
            $obra->rua = $request->rua;
            $obra->numero = $request->numero;
            $obra->complemento = $request->complemento;
            $obra->cep = $request->cep;
            $obra->bairro = $request->bairro;
            $obra->cidade = $request->cidade;
            $obra->uf = $request->uf;
            $obra->cliente = $request->cliente;
            if($obra->save()){
                foreach ($funcionario as $id){
                    $funcionarios_obra = new Funcionarios_Obra();
                    $funcionarios_obra->funcionario=$id;
                    $funcionarios_obra->obra=$obra->id;
                    $funcionarios_obra->save();
                }
                return redirect()->route('obras.show');
            }
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Obra $obra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obra $obra)
    {
        if (Auth::check() === true) {
            $obra->status_db = 0;
            $obra->save();
            return redirect()->route('obras.show');
        }
        return redirect()->route('dashboard.login');
    }

    public function gerenciar()
    {
        if (Auth::check() === true) {
            $obras = Obra::all()->where('status_db', 1)->where('data_final', '=', null)->where('data_inicio', '!=', null);
            if(count($obras) == 1){
                return redirect()->route('obras.faltas', ['obra'=>$obras->first()]);
            }
            return view('obras_ativas', [
                'obras' => $obras
            ]);
        }
        return redirect()->route('dashboard.login');
    }

    public function concluir(Obra $obra)
    {
        if (Auth::check() === true) {
            $obra->data_final = date('Y-m-d H:i:s');
            if($obra->save()){
                return redirect()->route('obras.ativas');
            }
        }
        return redirect()->route('dashboard.login');
    }

    public function faltas(Obra $obra)
    {
        if (Auth::check() === true) {
            $faltas_obra = Faltas_Obra::all()->where('obra', $obra->id)->whereBetween('created_at', [date('Y-m-d'), date('Y-m-d 23:59:59.998')]);
            if(count($faltas_obra) > 0){
                return redirect()->route('obras.show')->withErrors(['Registro de falta dessa obra já foi feito hoje']);
            }
            $funcionarios = $obra->funcionario()->get();
            return view('faltas_obras', ['obra'=>$obra, 'funcionarios'=>$funcionarios]);
        }
        return redirect()->route('dashboard.login');
    }

    public function registrarFaltas(Obra $obra, Request $request)
    {
        if (Auth::check() === true) {
            $funcionarios = $obra->funcionario()->get();
            foreach ($funcionarios as $id){
                $faltas_obras = new Faltas_Obra();
                $faltas_obras->funcionario = $id->id;
                $faltas_obras->obra = $obra->id;
                if(isset($request['falta'.$id->id])){
                    $faltas_obras->falta = 1;
                    $faltas_obras->meio_dia = 0;
                }elseif(isset($request['meio_dia'.$id->id])){
                    $faltas_obras->falta = 0;
                    $faltas_obras->meio_dia = 1;
                }else{
                    $faltas_obras->falta = 0;
                    $faltas_obras->meio_dia = 0;
                }
                $faltas_obras->save();
            }
            return redirect()->route('obras.show');
        }
        return redirect()->route('dashboard.login');
    }

    public function relatorio(Obra $obra)
    {
        if (Auth::check() === true) {
            $salarios = $obra->faltas()->whereBetween('created_at', [date('Y-m-1'), date('Y-m-d 23:59:59.998')])->get();
            $funcionarios = $obra->funcionario()->get();
            return view('relatorio_obra', ['obra'=>$obra, 'salarios'=>$salarios, 'funcionarios'=>$funcionarios]);
        }
        return redirect()->route('dashboard.login');
    }
}
