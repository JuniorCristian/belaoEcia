<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Faltas_Obra;
use App\Models\FaseObra;
use App\Models\Funcionario;
use App\Models\Funcionarios_Obra;
use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\String_;
use Yajra\DataTables\Facades\DataTables;
use function GuzzleHttp\Promise\all;
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
            $obra = new Obra();
            $obra->cliente = '';
            $obra->data_inicio_prevista = date('Y-m-d');
            $obra->data_final_prevista = date('Y-m-'.(date('d')+1));
            $clientes = Cliente::all()->where('status_db', 1);
            $funcionarios = Funcionario::all()->where('status_db', 1);
            return view('obras.create', compact('clientes', 'funcionarios', 'obra'));
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
            foreach ($funcionarios as $key => $func) {
                if (isset($request['funcionario' . $func->id]) && $request['funcionario' . $func->id]) {
                    $funcionario[$key] = $func->id;
                }
            }
            $obra = new Obra();
            $obra->orcamento = number_format(floatval($request->orcamento), '2', '.', ',');
            if (isset($request->has_orcamento_materias)) {
                $obra->orcamento_material = number_format(floatval($request->orcamento_materias), '2', '.', ',');
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
            if ($obra->save()) {
                foreach ($funcionario as $id) {
                    $funcionarios_obra = new Funcionarios_Obra();
                    $funcionarios_obra->funcionario = $id;
                    $funcionarios_obra->obra = $obra->id;
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
            return view('obras.show');
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
            $obra->orcamento = number_format($obra->orcamento, "0", ",", ".");
            $obra->orcamento_material = number_format($obra->orcamento_material, "0", ",", ".");
            $funcionarios = Funcionario::all()->where('status_db', 1);
            $clientes = Cliente::all()->where('status_db', 1);
            return view('obras.edit', [
                'obra' => $obra,
                'funcionarios' => $funcionarios,
                'clientes' => $clientes
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
            foreach ($funcionarios as $funcionario) {
                $funcionario->delete();
            }
            $funcionarios = Funcionario::all();
            foreach ($funcionarios as $key => $func) {
                if (isset($request['funcionario' . $func->id]) && $request['funcionario' . $func->id]) {
                    $funcionario[$key] = $func->id;
                }
            }
            $obra->orcamento = number_format(floatval($request->orcamento), '2', '.', ',');
            if (isset($request->has_orcamento_materias)) {
                $obra->orcamento_material = number_format(floatval($request->orcamento_materias), '2', '.', ',');
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
            if ($obra->save()) {
                foreach ($funcionario as $id) {
                    $funcionarios_obra = new Funcionarios_Obra();
                    $funcionarios_obra->funcionario = $id;
                    $funcionarios_obra->obra = $obra->id;
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
            if (count($obras) == 1) {
                return redirect()->route('obras.faltas', ['obra' => $obras->first()]);
            }
            return view('obras.active', [
                'obras' => $obras
            ]);
        }
        return redirect()->route('dashboard.login');
    }

    public function concluir(Obra $obra)
    {
        if (Auth::check() === true) {
            $obra->data_final = date('Y-m-d H:i:s');
            if ($obra->save()) {
                return redirect()->route('obras.ativas');
            }
        }
        return redirect()->route('dashboard.login');
    }

    public function faltas(Obra $obra)
    {
        if (Auth::check() === true) {
            $faltas_obra = Faltas_Obra::get()->where('obra', $obra->id)->whereBetween('created_at', [date('Y-m-d'), date('Y-m-d 23:59:59.998')]);
            if (count($faltas_obra) > 0) {
                return redirect()->route('obras.show')->withErrors(['Registro de falta dessa obra já foi feito hoje']);
            }
            $funcionarios = $obra->funcionario()->get();
            return view('obras.faltas', ['obra' => $obra, 'funcionarios' => $funcionarios]);
        }
        return redirect()->route('dashboard.login');
    }

    public function registrarFaltas(Obra $obra, Request $request)
    {
        if (Auth::check() === true) {
            $funcionarios = $obra->funcionario()->get();
            foreach ($funcionarios as $id) {
                $faltas_obras = new Faltas_Obra();
                $faltas_obras->funcionario = $id->id;
                $faltas_obras->obra = $obra->id;
                if (isset($request['falta' . $id->id])) {
                    $faltas_obras->falta = 1;
                    $faltas_obras->meio_dia = 0;
                } elseif (isset($request['meio_dia' . $id->id])) {
                    $faltas_obras->falta = 0;
                    $faltas_obras->meio_dia = 1;
                } else {
                    $faltas_obras->falta = 0;
                    $faltas_obras->meio_dia = 0;
                }
                $faltas_obras->dia_pago = 0;
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
            return view('obras.relatorio', ['obra' => $obra, 'salarios' => $salarios, 'funcionarios' => $funcionarios]);
        }
        return redirect()->route('dashboard.login');
    }

    public function datatable(Request $request)
    {

        $columns = array(
            0 => 'cliente',
            1 => 'orcamento',
            2 => 'endereco',
            3 => 'data_inicial',
            4 => 'data_final',
            5 => 'status',
            6 => 'acoes',
        );

        $totalData = Obra::get()->where("status_db", "1")->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $datatables = Obra::where("status_db", "1")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $datatables =  Obra::where("status_db", "1")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Obra::where("status_db", "1")
                ->count();
        }

        return DataTables::of($datatables)
            ->editColumn('status', function ($row) {
                if ($row['data_inicio'] == null && $row['data_final'] == null) {
                    return "<label class=\"label-inativa\">Inativa</label> ";
                } elseif ($row['data_inicio'] != null && $row['data_final'] == null) {
                    return "<label class=\"label-andamento\">Em andamento</label> ";
                } elseif ($row['data_inicio'] != null && $row['data_final'] != null) {
                    return "<label class=\"label-concluido\">Concluida</label> ";
                } else{
                    return "<label class=\"label-indisponivel\">Indisponivel</label> ";
                }

            })
            ->editColumn('cliente', function ($row){
                return $row->cliente()->first()->nome;
            })
            ->editColumn('orcamento', function ($row){
                return "R$".number_format($row['orcamento'] + $row['orcamento_material'], '2', ',', '.');
            })
            ->editColumn('endereco', function ($row){
                return "Rua ".$row['rua'].", ".$row['numero']." ".$row['cidade']."-".$row['uf'];
            })
            ->editColumn('data_inicial', function ($row){
                return date('d/m/Y', strtotime(($row['data_inicio'] != null) ? $row['data_inicio'] : $row['data_inicio_prevista']));;
            })
            ->editColumn('data_final', function ($row){
                return date('d/m/Y', strtotime(($row['data_final'] != null) ? $row['data_final'] : $row['data_final_prevista']));;
            })
            ->addColumn('acoes', function ($row)  {
                $acoes = "<div class='botoes-datatable d-flex'>";

                $acoes .= '<a class="edit editar-datatable" href="'.route('obras.edit', ['obra'=>$row['id']]).'">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<a class="deleta excluir-datatable" data-csrf="'.csrf_token().'" data-rota="'.route('obras.delete', ['obra'=>$row['id']]).'" data-id="'.$row['id'].'">
                        <i class="fa fa-trash" style="color: #fff"></i></a>';

                $acoes .= '<a class="datatable-relatorio" href="'.route('obras.relatorio', ['obra'=>$row['id']]).'">
                        <i class="fa fa-chart-bar" style="color: #fff"></i></a>';

                $acoes .= '<a class="gerenciar-fases" href="'.route('obras.fase', ['obra', $row->id]).'">
                        <i class="fas fa-percentage" style="color: #fff"></i></a>';

                $acoes .= '<a class="gerenciar-materiais" href="'.route('obras.materiais', ['obra' => $row['id']]).'">
                        <i class="fas fa-toolbox" style="color: #fff"></i></a>';

                $acoes .= "</div>";

                return $acoes;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function datatableAtivas(Request $request)
    {

        $columns = array(
            0 => 'cliente',
            1 => 'orcamento',
            2 => 'gastos',
            3 => 'endereco',
            4 => 'data_start',
            5 => 'acoes',
        );

        $totalData = Obra::get()->where("data_inicio", "!=", null)->where("data_final", "=", null)->where("status_db", "1")->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $datatables = Obra::where("data_inicio", "!=", null)->where("data_final", "=", null)->where("status_db", "1")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $data = array();
        if (!empty($datatables)) {
            foreach ($datatables as $key => $datatable) {


                $newData['cliente'] = $datatable->cliente()->first()->nome;
                $newData['orcamento'] = $datatable->orcamento + $datatable->orcamento_material;
                $newData['endereco'] = "Rua $datatable->rua, $datatable->numero $datatable->cidade-$datatable->uf";
                $newData['acoes'] = '';
                $newData['gastos'] = 0;

                $newData['gastos'] = "R$" . number_format($newData['gastos'], "2", ",", ".");
                $newData['orcamento'] = "R$" . number_format($datatable->orcamento, "2", ",", ".");
                $newData['data_start'] = date('d/m/Y', strtotime($datatable->data_inicio));
                $data[] = $newData;
            }
        }
        return DataTables::of($datatables)
            ->editColumn('status', function ($row) {
                if ($row['data_inicio'] == null && $row['data_final'] == null) {
                    return "<label class=\"label-inativa\">Inativa</label> ";
                } elseif ($row['data_inicio'] != null && $row['data_final'] == null) {
                    return "<label class=\"label-andamento\">Em andamento</label> ";
                } elseif ($row['data_inicio'] != null && $row['data_final'] != null) {
                    return "<label class=\"label-concluido\">Concluida</label> ";
                } else{
                    return "<label class=\"label-indisponivel\">Indisponivel</label> ";
                }

            })
            ->editColumn('cliente', function ($row){
                return $row->cliente()->first()->nome;
            })
            ->editColumn('orcamento', function ($row){
                return "R$".number_format($row['orcamento'] + $row['orcamento_material'], '2', ',', '.');
            })
            ->editColumn('gastos', function ($row){
                $gastos = $row->faltas()->get();
                $valor = 0;
                foreach ($gastos as $gasto) {
                    $valor += $gasto->valor;
                }
                return "R$".number_format($valor, '2', ',', '.');
            })
            ->editColumn('endereco', function ($row){
                return "Rua ".$row['rua'].", ".$row['numero']." ".$row['cidade']."-".$row['uf'];
            })
            ->editColumn('data_start', function ($row){
                return date('d/m/Y', strtotime($row['data_inicio']));
            })
            ->addColumn('acoes', function ($row)  {
                $acoes = "<div class='botoes-datatable d-flex'>";
                $acoes .= '<a class="edit editar-datatable" href="'.route('obras.edit', ['obra'=>$row['id']]).'">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<a class="datatable-conclui" data-id="'.$row['id'].'" class="conclui" data-csrf="'.csrf_token().'" data-rota="'.route('obras.concluir', ['obra' => $row['id']]).'">
                        <i class="fa fa-check" style="color: #fff"></i></a>';

                $acoes .= '<a class="datatable-faltas" href="'.route('obras.faltas', ['obra' => $row['id']]).'">
                        <i class="fas fa-hard-hat" style="color: #fff"></i></a>';

                $acoes .= '<a class="gerenciar-fases" href="'.route('obras.fase', ['obra' => $row['id']]).'">
                        <i class="fas fa-percentage" style="color: #fff"></i></a>';

                $acoes .= '<a class="gerenciar-materiais" href="'.route('obras.materiais', ['obra' => $row['id']]).'">
                        <i class="fas fa-toolbox" style="color: #fff"></i></a>';

                $acoes .= "</div>";

                return $acoes;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function datatableRelatorio(Request $request, Obra $obra)
    {

        if (isset($request->data_inicio)) {
            $data_inicio = date('Y-m-d', strtotime($request->data_inicio));
        } else {
            $data_inicio = date('Y-m-1');
        }
        if (isset($request->data_final)) {
            $data_final = date('Y-m-d 23:59:59.998', strtotime($request->data_final));
        } else {
            $data_final = date('Y-m-d 23:59:59.998');
        }
        if ($request->a_pagar == "true" && $request->pago == "false") {
            $dia_pago = 0;
        } elseif ($request->a_pagar == "false" && $request->pago == "true") {
            $dia_pago = 1;
        } else {
            $dia_pago = "";
        }

        $columns = array(
            0 => 'nome',
            1 => 'num_faltas',
            2 => 'num_meio_dia',
            3 => 'salario_mes',
            4 => 'tempo_pago',
        );

        $totalData = $obra->funcionario()->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $datatables = $obra->funcionario()->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $data = array();
        $salario_total = 0;
        if (!empty($datatables)) {
            foreach ($datatables as $key => $datatable) {
                $faltas = $datatable->faltas()->whereBetween('created_at', [$data_inicio, $data_final])->orderBy("created_at", "asc")->where('dia_pago', "LIKE", "%" . $dia_pago . "%")->get();
                $newData['nome'] = $datatable->nome;
                $newData['num_faltas'] = 0;
                $newData['num_meio_dia'] = 0;
                $newData['salario_mes'] = 0;
                $newData['tempo_pago'] = "Sem pagamento";
                $pago = 0;
                $nao_pago = 0;
                if (!empty($faltas)) {
                    foreach ($faltas as $falta) {
                        $newData['num_faltas'] += $falta->falta;
                        $newData['num_meio_dia'] += $falta->meio_dia;
                        $newData['salario_mes'] += $falta->valor;
                        if ($falta->dia_pago) {
                            $pago += 1;
                        } else {
                            $nao_pago += 1;
                        }
                    }
                    $salario_total += $newData['salario_mes'];
                    $newData['salario_mes'] = "R$" . number_format($newData['salario_mes'], "2", ",", ".");
                    if ($pago > 0 && $nao_pago == 0) {
                        $newData['tempo_pago'] = "Pago";
                    } elseif ($pago == 0 && $nao_pago > 0) {
                        $newData['tempo_pago'] = "A pagar";
                    } elseif ($pago > 0 && $nao_pago > 0) {
                        $newData['tempo_pago'] = "Pagamento parcial";
                    }
                }
                $data[] = $newData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
            "salario_total" => "R$" . number_format($salario_total, "2", ",", ".")
        );

        return json_encode($json_data);
    }

    public function datatableRelatorioFuncionario(Request $request, Obra $obra)
    {
        if (isset($request->data_inicio)) {
            $data_inicio = date('Y-m-d', strtotime($request->data_inicio));
        } else {
            $data_inicio = date('Y-m-1');
        }
        if (isset($request->data_final)) {
            $data_final = date('Y-m-d 23:59:59.998', strtotime($request->data_final));
        } else {
            $data_final = date('Y-m-d 23:59:59.998');
        }
        if (isset($request->funcionario)) {
            $funcionario = $request->funcionario;
        } else {
            $funcionario = "";
        }
        if ($request->a_pagar == "true" && $request->pago == "false") {
            $dia_pago = 0;
        } elseif ($request->a_pagar == "false" && $request->pago == "true") {
            $dia_pago = 1;
        } else {
            $dia_pago = "";
        }

        $columns = array(
            0 => 'created_at',
            1 => 'falta',
            2 => 'salario_dia',
            3 => 'dia_pago',
        );

        $totalData = $obra->funcionario()->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $datatables = $obra->faltas()->whereBetween('created_at', [$data_inicio, $data_final])->where('funcionario', "LIKE", "%" . $funcionario . "%")->where('dia_pago', "LIKE", "%" . $dia_pago . "%")->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();


        $totalFiltered = $obra->faltas()->whereBetween('created_at', [$data_inicio, $data_final])->where('funcionario', "LIKE", "%" . $funcionario . "%")->where('dia_pago', "LIKE", "%" . $dia_pago . "%")->count();

        $data = array();
        $salario_total = 0;
        if (!empty($datatables)) {
            foreach ($datatables as $key => $datatable) {
                $newData['data'] = date("d/m/Y", strtotime($datatable->created_at));
                $newData['salario_dia'] = "R$" . number_format($datatable->valor, "2", ",", ".");
                if ($datatable->dia_pago) {
                    $newData['dia_pago'] = "Pago";
                } else {
                    if ($datatable->falta) {
                        $newData['dia_pago'] = "Sem pagamento";
                    } else {
                        $newData['dia_pago'] = "A pagar";
                    }
                }
                if ($datatable->falta) {
                    $newData['falta'] = 'Faltou';
                } elseif ($datatable->meio_dia) {
                    $newData['falta'] = 'Meio Dia';
                } else {
                    $newData['falta'] = 'Dia completo';
                }
                $salario_total += $datatable->valor;
                $data[] = $newData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
            "salario_total" => "R$" . number_format($salario_total, "2", ",", ".")
        );

        return json_encode($json_data);
    }

    public function fase(Obra $obra)
    {
        $fase_obra = $obra->fases()->where('inicio', '!=', null)->where('final', null)->first();
        $fase_obra->nome = $fase_obra->fase()->first()->nome;

        return view('obras.fase_obra', compact('obra', 'fase_obra'));
    }

    public function materiais(Obra $obra)
    {
        return view('obras.materias');
    }
}
