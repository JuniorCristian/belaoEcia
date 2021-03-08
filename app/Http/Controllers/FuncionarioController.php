<?php

namespace App\Http\Controllers;

use App\Models\Faltas_Obra;
use App\Models\Funcionario;
use App\Models\Obra;
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
            return view('funcionarios.create');
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
            return view('funcionarios.show', [
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
            return view('funcionarios.edit', ['funcionario'=>$funcionario]);
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
            return view('funcionarios.salario', ['obras'=>$obras, 'salarios'=>$salarios, 'funcionario'=>$funcionario]);
        }
        return redirect()->route('dashboard.login');
    }

    public function pagar(Request $request, Obra $obra)
    {
        if(isset($request->data_inicio)){
            $data_inicio = date('Y-m-d', strtotime($request->data_inicio));
        }else{
            $data_inicio = date('Y-m-1');
        }
        if(isset($request->data_final)){
            $data_final = date('Y-m-d 23:59:59.998', strtotime($request->data_final));
        }else{
            $data_final = date('Y-m-d 23:59:59.998');
        }
        if(isset($request->funcionario)){
            $funcionario = $request->funcionario;
        }else{
            $funcionario = "";
        }
        $datatables = $obra->faltas()->whereBetween('created_at', [$data_inicio, $data_final])->where('funcionario', "LIKE",  "%".$funcionario."%")->orderBy("created_at", "asc")->get();;

        foreach ($datatables as $key=>$datatable){
            $datatable->dia_pago = 1;
            $datatable->save();
        }

        return json_encode(['status'=>true]);
    }

    public function datatable(Request $request)
    {
        $columns = array(
            0 => 'nome',
            1 => 'função',
            2 => 'cpf',
            3 => 'salario',
            4 => 'obras',
            5 => 'editar',
            6 => 'excluir',
            6 => 'salarios',
        );

        $totalData = Funcionario::get()->where("status_db", "1")->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $datatables = Funcionario::where("status_db", "1")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $datatables =  Obra::where("status_db", "1")
                ->where('nome', 'like', '%'.$search.'%')
                ->orWhere('cpf', 'like', '%'.$search.'%')
                ->orWhere('funcao', 'like', '%'.$search.'%')
                ->orWhere('salario_dia', 'like', '%'.$search.'%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Obra::where("status_db", "1")
                ->count();
        }

        $data = array();
        if (!empty($datatables)) {
            foreach ($datatables as $key => $datatable) {
                $newData['nome'] = $datatable->nome;
                $newData['cpf'] = $datatable->cpf;
                $newData['funcao'] = $datatable->funcao;
                $newData['salario'] = "R$" . number_format($datatable->salario_dia, "2", ",", ".");
                $newData['obras'] = $datatable->obras()->get()->count();
                $newData['editar'] = '<a href="'.route('funcionarios.edit', ['funcionario'=>$datatable->id]).'"><iclass="fa fa-edit"></i></a>';
                $newData['excluir'] = '<a data-csrf="'.csrf_token().'" data-rota="'.route('funcionarios.delete', ['funcionario'=>$datatable->id]).'" data-id="'.$datatable->id.'" class="deleta"><i class="fa fa-trash"></i></a>';
                $newData['salarios'] = '<a href="'.route('funcionarios.salario', ['funcionario'=>$datatable->id]).'"><i class="fa fa-money-bill-wave"></i></a>';
                $data[] = $newData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        return json_encode($json_data);
    }
}
