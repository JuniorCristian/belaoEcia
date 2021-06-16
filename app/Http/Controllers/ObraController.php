<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Faltas_Obra;
use App\Models\Fase;
use App\Models\FaseObra;
use App\Models\FaseObraImagem;
use App\Models\Funcionario;
use App\Models\Funcionarios_Obra;
use App\Models\HistoricoMaterial;
use App\Models\MateriaisObraFase;
use App\Models\Material;
use App\Models\Obra;
use App\Repository\AutodeskAPI;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('obras.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obra = new Obra();
        $obra->cliente = '';
        $obra->data_inicio_prevista = Carbon::now();
        $obra->data_final_prevista = Carbon::now()->addDay();
        $clientes = Cliente::all()->where('status_db', 1);
        $funcionarios = Funcionario::all()->where('status_db', 1);
        $fases = Fase::all()->pluck('nome', 'id');
        $fases_selecionadas = [];
        return view('obras.create', compact('clientes', 'funcionarios', 'obra', 'fases', 'fases_selecionadas'));
    }


    public function carregaProjeto()
    {
        $requestData = new \stdClass();
        $apiAutodesk = new AutodeskAPI();
        $requestData->bucket_name = "belao_e_cia_bucket_teste_aaaaaaaaaaa";
        $requestData->file = "storage/rac_basic_sample_project.rvt";
        $requestData->file_name = "teste_basic_sample_project.rvt";
        $chao = 0;
        $parede = 0;
        $viga = 0;
        $area_chao = 0;
        $parametros = ParamentrosOrcamento::paramentros();
        $cimento = Material::where('id', 4)->first()->lista()->get();
        $areia = Material::where('id', 5)->first()->lista()->get();
        $pedra = Material::where('id', 6)->first()->lista()->get();
        $cal = Material::where('id', 7)->first()->lista()->get();
        $tijolo = Material::where('id', 8)->first()->lista()->get();
        $retorno = $apiAutodesk->getModelDerivativeProperties($requestData);
        foreach ($retorno['data']['collection'] as $data){
            if((strpos($data['name'], 'Floor') !== false || strpos($data['name'], 'Wall') !== false || strpos($data['name'], 'M_Pile-Steel Pipe') !== false || strpos($data['name'], 'Pile Cap-Rectangular') !== false || strpos($data['name'], 'Column') !== false) && isset($data['properties']['Dimensions'])){
                if(strpos($data['name'], 'Floor') !== false && strpos($data['properties']['Identity Data']['Type Name'], 'Concrete') !== false){
                    $chao += str_replace(' m^3', '', $data['properties']['Dimensions']['Volume']);
                    $area_chao += str_replace(' m^2', '', $data['properties']['Dimensions']['Area']);
                }
                if(strpos($data['name'], 'Basic Wall') !== false && strpos($data['properties']['Materials and Finishes']['Structural Material'], 'Concrete') !== false){
                    $parede += str_replace(' m^2', '', $data['properties']['Dimensions']['Area']);
                }
                if(strpos($data['name'], 'M_Pile-Steel Pipe') !== false){
                    $raio = str_replace(' mm', '', $data['properties']['Dimensions']['Radius'])/1000;
                    $profundidade = str_replace(' mm', '', $data['properties']['Dimensions']['Depth'])/1000;
                    $viga += ($raio*$raio)*pi()*$profundidade;
                }
            }
        }
        $chao = ($chao/0.55)*0.10;
        $preco_parede = [];
        $preco_chao = [];
        $preco_tijolo = [];
        $preco_cimento = [];
        $preco_areia = [];
        $preco_pedra = [];
        $preco_cal = [];
        $preco_total = [];
        foreach ($tijolo as $loja){
            if(!isset($preco_parede[$loja->loja]['tijolo'])){
                $preco_parede[$loja->loja]['tijolo'] = 0;
            }
            if(!isset($preco_parede[$loja->loja]['total'])){
                $preco_parede[$loja->loja]['total'] = 0;
            }
            if(!isset($preco_total[$loja->loja]['total'])){
                $preco_total[$loja->loja]['total'] = 0;
            }
            $preco_tijolo[$loja->loja]['preco'] = ceil($parametros['parede']['tijolos']*$parede)*$loja->preco;
            $preco_tijolo[$loja->loja]['quantidade'] = ceil($parametros['parede']['tijolos']*$parede);
            $preco_tijolo[$loja->loja]['unidade'] = 'Unidades';
            $preco_tijolo[$loja->loja]['id_material'] = $loja->material;
            $preco_parede[$loja->loja]['tijolo'] += $preco_tijolo[$loja->loja]['preco'];
            $preco_parede[$loja->loja]['total'] += $preco_tijolo[$loja->loja]['preco'];
            $preco_total[$loja->loja]['tijolo'] = $preco_tijolo[$loja->loja];
            $preco_total[$loja->loja]['total'] += $preco_tijolo[$loja->loja]['preco'];
        }
        foreach ($cimento as $loja){
            if(!isset($preco_parede[$loja->loja]['cimento'])){
                $preco_parede[$loja->loja]['cimento'] = 0;
            }
            if(!isset($preco_parede[$loja->loja]['total'])){
                $preco_parede[$loja->loja]['total'] = 0;
            }
            if(!isset($preco_chao[$loja->loja]['cimento'])){
                $preco_chao[$loja->loja]['cimento'] = 0;
            }
            if(!isset($preco_chao[$loja->loja]['total'])){
                $preco_chao[$loja->loja]['total'] = 0;
            }
            if(!isset($preco_total[$loja->loja]['total'])){
                $preco_total[$loja->loja]['total'] = 0;
            }
            $cimento_parede = (ceil(($parametros['reboco']['saco_cimento']*$parede)+($parametros['reboco']['saco_cimento']*$parede*$parametros['parede']['area_reboco'])));
            $cimento_chao = ceil(($parametros['concreto']['saco_cimento']*(($chao/0.10)*0.1-$parametros['contrapiso']['espessura']) + ($parametros['contrapiso']['saco_cimento']*(($chao/10)*$parametros['contrapiso']['espessura']))));
            $preco_cimento[$loja->loja]['preco'] = ($cimento_chao+$cimento_parede)*$loja->preco;
            $preco_cimento[$loja->loja]['quantidade'] = $cimento_chao+$cimento_parede;
            $preco_cimento[$loja->loja]['unidade'] = 'Unidades';
            $preco_cimento[$loja->loja]['id_material'] = $loja->material;
            $preco_parede[$loja->loja]['cimento'] += $cimento_parede*$loja->preco;
            $preco_parede[$loja->loja]['total'] += $cimento_parede*$loja->preco;
            $preco_chao[$loja->loja]['cimento'] += $cimento_chao*$loja->preco;
            $preco_chao[$loja->loja]['total'] += $cimento_chao*$loja->preco;
            $preco_total[$loja->loja]['cimento'] = $preco_cimento[$loja->loja];
            $preco_total[$loja->loja]['total'] += $preco_cimento[$loja->loja]['preco'];
        }
        foreach ($areia as $loja){
            if(!isset($preco_parede[$loja->loja]['areia'])){
                $preco_parede[$loja->loja]['areia'] = 0;
            }
            if(!isset($preco_parede[$loja->loja]['total'])){
                $preco_parede[$loja->loja]['total'] = 0;
            }
            if(!isset($preco_chao[$loja->loja]['areia'])){
                $preco_chao[$loja->loja]['areia'] = 0;
            }
            if(!isset($preco_chao[$loja->loja]['total'])){
                $preco_chao[$loja->loja]['total'] = 0;
            }
            if(!isset($preco_total[$loja->loja]['total'])){
                $preco_total[$loja->loja]['total'] = 0;
            }
            $areia_parede = ceil(($parametros['reboco']['areia']*$parede)+($parametros['reboco']['areia']*$parede*$parametros['parede']['area_reboco']));
            $areia_chao = ceil(($parametros['concreto']['areia']*(($chao/0.10)*0.1-$parametros['contrapiso']['espessura']))+($parametros['contrapiso']['areia']*(($chao/0.10)*$parametros['contrapiso']['espessura'])));
            $preco_areia[$loja->loja]['preco'] = ($areia_parede+$areia_chao)*$loja->preco;
            $preco_areia[$loja->loja]['quantidade'] = $areia_parede+$areia_chao;
            $preco_areia[$loja->loja]['unidade'] = 'm³';
            $preco_areia[$loja->loja]['id_material'] = $loja->material;
            $preco_parede[$loja->loja]['areia'] += $areia_parede*$loja->preco;
            $preco_parede[$loja->loja]['total'] += $areia_parede*$loja->preco;
            $preco_chao[$loja->loja]['areia'] += $areia_chao*$loja->preco;
            $preco_chao[$loja->loja]['total'] += $areia_chao*$loja->preco;
            $preco_total[$loja->loja]['areia'] = $preco_areia[$loja->loja];
            $preco_total[$loja->loja]['total'] += $preco_areia[$loja->loja]['preco'];
        }
        foreach ($pedra as $loja){
            if(!isset($preco_chao[$loja->loja]['pedra'])){
                $preco_chao[$loja->loja]['pedra'] = 0;
            }
            if(!isset($preco_chao[$loja->loja]['total'])){
                $preco_chao[$loja->loja]['total'] = 0;
            }
            if(!isset($preco_total[$loja->loja]['total'])){
                $preco_total[$loja->loja]['total'] = 0;
            }
            $pedra_chao = ceil($parametros['concreto']['pedra']*$chao);
            $preco_pedra[$loja->loja]['preco'] = ($pedra_chao)*$loja->preco;
            $preco_pedra[$loja->loja]['quantidade'] = $pedra_chao;
            $preco_pedra[$loja->loja]['unidade'] = 'm³';
            $preco_pedra[$loja->loja]['id_material'] = $loja->material;
            $preco_chao[$loja->loja]['pedra'] += $pedra_chao*$loja->preco;
            $preco_chao[$loja->loja]['total'] += $pedra_chao*$loja->preco;
            $preco_total[$loja->loja]['pedra'] = $preco_pedra[$loja->loja];
            $preco_total[$loja->loja]['total'] += $preco_pedra[$loja->loja]['preco'];
        }
        foreach ($cal as $loja){
            if(!isset($preco_parede[$loja->loja]['cal'])){
                $preco_parede[$loja->loja]['cal'] = 0;
            }
            if(!isset($preco_parede[$loja->loja]['total'])){
                $preco_parede[$loja->loja]['total'] = 0;
            }
            if(!isset($preco_total[$loja->loja]['total'])){
                $preco_total[$loja->loja]['total'] = 0;
            }
            $preco_cal[$loja->loja]['preco'] = ceil(($parametros['reboco']['cal']*$parede)+($parametros['reboco']['cal']*$parede*$parametros['parede']['area_reboco']))*$loja->preco;
            $preco_cal[$loja->loja]['quantidade'] = ceil(($parametros['reboco']['cal']*$parede)+($parametros['reboco']['cal']*$parede*$parametros['parede']['area_reboco']));
            $preco_cal[$loja->loja]['unidade'] = 'Unidades';
            $preco_cal[$loja->loja]['id_material'] = $loja->material;
            $preco_parede[$loja->loja]['cal'] += $preco_cal[$loja->loja]['preco'];
            $preco_parede[$loja->loja]['total'] += $preco_cal[$loja->loja]['preco'];
            $preco_total[$loja->loja]['cal'] = $preco_cal[$loja->loja];
            $preco_total[$loja->loja]['total'] += $preco_cal[$loja->loja]['preco'];
        }
        return compact('preco_total',
        'preco_parede',
        'preco_chao',
        'preco_pedra',
        'preco_tijolo',
        'preco_cal',
        'preco_areia',
        'preco_cimento',
        'parede',
        'chao',
        'viga');
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $obra = new Obra();
            $obra->orcamento = str_replace(',', '.', str_replace('.', '', $request->orcamento));
            if (isset($request->has_orcamento_materias)) {
                $obra->orcamento_material = str_replace(',', '.', str_replace('.', '', $request->orcamento_materias));
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
            $obra->save();
            foreach ($request->funcionario as $id) {
                $funcionarios_obra = new Funcionarios_Obra();
                $funcionarios_obra->funcionario = $id;
                $funcionarios_obra->obra = $obra->id;
                $funcionarios_obra->save();
            }
            foreach ($request->fase as $f) {
                $fase_obra = new FaseObra();
                $fase_obra->obra = $obra->id;
                $fase_obra->fase = $f;
                $fase_obra->save();
            }
            DB::commit();
            Session::flash('success_message', 'Obra adicionada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Falha ao adicionar Obra!');
        }
        return redirect()->route('obras.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Obra $obra
     * @return \Illuminate\Http\Response
     */
    public function edit(Obra $obra)
    {
        $obra->funcionario = $obra->funcionario()->get();
        $obra->orcamento = number_format($obra->orcamento, 2, ",", ".");
        $obra->orcamento_material = number_format($obra->orcamento_material, 2, ",", ".");
        $funcionarios = Funcionario::all()->where('status_db', 1);
        $clientes = Cliente::all()->where('status_db', 1);
        $fases = Fase::all()->pluck('nome', 'id');
        $fases_selecionadas = $obra->fases()->get();
        return view('obras.edit', compact('obra', 'funcionarios', 'clientes', 'fases', 'fases_selecionadas'));
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
        DB::beginTransaction();
        try {
            Funcionarios_Obra::where('obra', $obra->id)->delete();
            FaseObra::where('obra', $obra->id)->delete();
            $obra->orcamento = str_replace(',', '.', str_replace('.', '', $request->orcamento));
            if (isset($request->has_orcamento_materias)) {
                $obra->orcamento_material = str_replace(',', '.', str_replace('.', '', $request->orcamento_materias));
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
            $obra->save();
            foreach ($request->funcionario as $id) {
                $funcionarios_obra = new Funcionarios_Obra();
                $funcionarios_obra->funcionario = $id;
                $funcionarios_obra->obra = $obra->id;
                $funcionarios_obra->save();
            }
            foreach ($request->fase as $f) {
                $fase_obra = new FaseObra();
                $fase_obra->obra = $obra->id;
                $fase_obra->fase = $f;
                $fase_obra->save();
            }
            DB::commit();
            Session::flash('success_message', 'Obra atualizada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            Session::flash('error_message', 'Erro ao atualizar Obra!');
        }
        return redirect()->route('obras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Obra $obra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obra $obra)
    {
        DB::beginTransaction();
        try {
            $obra->delete();
            DB::commit();
            Session::flash('success_message', 'Obra deletada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('success_message', 'Erro ao deletar Obra!');
        }
        return redirect()->route('obras.index');
    }

    public function gerenciar()
    {
        $obras = Obra::where('data_final', '=', null)->where('data_inicio', '!=', null)->get();
        if (count($obras) == 1) {
            return redirect()->route('obras.faltas', ['obra' => $obras->first()]);
        }
        return view('obras.active', compact('obras'));
    }

    public function concluir(Obra $obra)
    {
        $obra->data_final = date('Y-m-d H:i:s');
        if ($obra->save()) {
            return redirect()->route('obras.ativas');
        }
    }

    public function faltas(Obra $obra)
    {
        $faltas_obra = Faltas_Obra::get()->where('obra', $obra->id)->whereBetween('created_at', [date('Y-m-d'), date('Y-m-d 23:59:59.998')]);
        if (count($faltas_obra) > 0) {
            Session::flash('warning_message', 'Registro de falta dessa obra já foi feito hoje!');
            return redirect()->route('obras.ativas');
        }
        $funcionarios = $obra->funcionario()->get();
        return view('obras.faltas', compact('obra', 'funcionarios'));
    }

    public function registrarFaltas(Obra $obra, Request $request)
    {
        $funcionarios = $obra->funcionario()->get();
        foreach ($funcionarios as $id) {
            $faltas_obras = new Faltas_Obra();
            $faltas_obras->funcionario = $id->id;
            $faltas_obras->valor = $id->salario_dia;
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
        return redirect()->route('obras.ativas');
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

        if (empty($request->input('search.value'))) {
            $datatables = Obra::where("status_db", "1")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $datatables = Obra::where("status_db", "1")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
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
                } else {
                    return "<label class=\"label-indisponivel\">Indisponivel</label> ";
                }

            })
            ->editColumn('cliente', function ($row) {
                return $row->cliente()->first()->nome;
            })
            ->editColumn('orcamento', function ($row) {
                return "R$" . number_format($row['orcamento'] + $row['orcamento_material'], '2', ',', '.');
            })
            ->editColumn('endereco', function ($row) {
                return "Rua " . $row['rua'] . ", " . $row['numero'] . " " . $row['cidade'] . "-" . $row['uf'];
            })
            ->editColumn('data_inicial', function ($row) {
                return date('d/m/Y', strtotime(($row['data_inicio'] != null) ? $row['data_inicio'] : $row['data_inicio_prevista']));;
            })
            ->editColumn('data_final', function ($row) {
                return date('d/m/Y', strtotime(($row['data_final'] != null) ? $row['data_final'] : $row['data_final_prevista']));;
            })
            ->addColumn('acoes', function ($row) {
                $acoes = "<div class='botoes-datatable d-flex'>";

                $acoes .= '<a class="edit editar-datatable" href="' . route('obras.edit', ['obra' => $row['id']]) . '">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<a class="deleta excluir-datatable" data-id="' . $row['id'] . '">
                        <i class="fa fa-trash" style="color: #fff"></i></a>';

                $acoes .= '<a class="datatable-relatorio" href="' . route('obras.relatorio', ['obra' => $row['id']]) . '">
                        <i class="fa fa-chart-bar" style="color: #fff"></i></a>';

                $acoes .= '<a class="gerenciar-fases" href="' . route('obras.fase', ['obra' => $row->id]) . '">
                        <i class="fas fa-percentage" style="color: #fff"></i></a>';

                $acoes .= '<a class="gerenciar-materiais" href="' . route('obras.materiais', ['obra' => $row['id']]) . '">
                        <i class="fas fa-toolbox" style="color: #fff"></i></a>';

                $acoes .= '<a class="orcamento-previo" href="' . route('obras.orcamento', ['obra' => $row['id']]) . '">
                        <i class="fas fa-cash-register" style="color: #fff"></i></a>';

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
                } else {
                    return "<label class=\"label-indisponivel\">Indisponivel</label> ";
                }

            })
            ->editColumn('cliente', function ($row) {
                return $row->cliente()->first()->nome;
            })
            ->editColumn('orcamento', function ($row) {
                return "R$" . number_format($row['orcamento'] + $row['orcamento_material'], '2', ',', '.');
            })
            ->editColumn('gastos', function ($row) {
                $gastos = $row->faltas()->get();
                $valor = 0;
                foreach ($gastos as $gasto) {
                    $valor += $gasto->valor;
                }
                return "R$" . number_format($valor, '2', ',', '.');
            })
            ->editColumn('endereco', function ($row) {
                return "Rua " . $row['rua'] . ", " . $row['numero'] . " " . $row['cidade'] . "-" . $row['uf'];
            })
            ->editColumn('data_start', function ($row) {
                return date('d/m/Y', strtotime($row['data_inicio']));
            })
            ->addColumn('acoes', function ($row) {
                $acoes = "<div class='botoes-datatable d-flex'>";
                $acoes .= '<a class="edit editar-datatable" href="' . route('obras.edit', ['obra' => $row['id']]) . '">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<a class="datatable-conclui" data-id="' . $row['id'] . '" class="conclui" data-csrf="' . csrf_token() . '" data-rota="' . route('obras.concluir', ['obra' => $row['id']]) . '">
                        <i class="fa fa-check" style="color: #fff"></i></a>';

                $acoes .= '<a class="datatable-faltas" href="' . route('obras.faltas', ['obra' => $row['id']]) . '">
                        <i class="fas fa-hard-hat" style="color: #fff"></i></a>';

                $acoes .= '<a class="gerenciar-fases" href="' . route('obras.fase', ['obra' => $row['id']]) . '">
                        <i class="fas fa-percentage" style="color: #fff"></i></a>';

                $acoes .= '<a class="gerenciar-materiais" href="' . route('obras.materiais', ['obra' => $row['id']]) . '">
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
        $fase_obra = $obra->fase_obra()->orderBy('inicio_previsto', 'ASC')->get();
        $fase_obra_ativa = $obra->fase_obra()->where('inicio', '!=', null)->where('final', null)->first();
        if (!isset($fase_obra_ativa)) {
            $fase_obra_ativa = $obra->fase_obra()->first();
        }
        $fase_obra_ativa->nome = $fase_obra_ativa->fase()->nome;

        return view('obras.fase_obra', compact('obra', 'fase_obra', 'fase_obra_ativa'));
    }

    public function faseUpdate(Request $request, Obra $obra)
    {
        DB::beginTransaction();
        try {
            $faseObra = FaseObra::where("id", $request->id_fase);
            $requestData['inicio_previsto'] = $request->inicio_previsto;
            $requestData['final_previsto'] = $request->final_previsto;
            $requestData['inicio'] = $request->inicio;
            $requestData['final'] = $request->final;
            $faseObra->update($requestData);
            DB::commit();
            return json_encode(['status' => 'true', 'message' => 'Fase editada com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(['status' => 'fase', 'message' => 'Falha ao editar fase!']);
        }


    }

    public function faseUpload(Request $request)
    {
        if (!is_dir('storage/fase_obra')) {
            mkdir('storage/fase_obra');
        }
        if (!is_dir('storage/fase_obra/' . $request->fase_obra)) {
            mkdir('storage/fase_obra/' . $request->fase_obra);
        }
        DB::beginTransaction();
        try {
            $images = [];
            $thumbs = [];
            $fase_id = [];
            foreach ($request->allFiles()['arquivos'] as $image) {
                $faseImage = new FaseObraImagem();
                $faseImage->fase_obra = $request->fase_obra;
                $faseImage->path = $image->store('fase_obra/' . $request->fase_obra);
                list($thumb['width'], $thumb['height']) = getimagesize('storage/' . $faseImage->path);
                $filename = $faseImage->path;
                $filename = str_replace('fase_obra/' . $request->fase_obra . '/', 'fase_obra/' . $request->fase_obra . '/thumb_', $filename);
                $faseImage->thumb_path = $filename;
                $faseImage->descricao = '';
                if ($thumb['width'] < $thumb['height']) {
                    $menorDistancia = $thumb['width'];
                } else {
                    $menorDistancia = $thumb['height'];
                }
                Image::make($image)->crop($menorDistancia, $menorDistancia,
                    intval($thumb['width'] / 2) - intval($menorDistancia / 2), intval($thumb['height'] / 2) - intval($menorDistancia / 2))->resize('300', '300')->save(public_path('storage/' . $filename));
                $images[] = $faseImage->path;
                $thumbs[] = $filename;
                $faseImage->save();
                $fase_id[] = $faseImage->id;
                unset($faseImage, $thumb);
            }
            DB::commit();
            return json_encode(['status' => true, 'images' => $images, 'thumbs' => $thumbs, 'fase_id' => $fase_id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(['status' => false, 'message' => 'Erro ao adicionar as imagens']);
        }
    }

    public function faseEdit(Request $request)
    {
        DB::beginTransaction();
        try {
            $fase_image = FaseObraImagem::where('id', $request->id_fase_imagem)->first();
            $fase_image->descricao = $request->descricao;
            $fase_image->save();
            DB::commit();
            return json_encode(['status' => true, 'message' => 'Descrição atualizada com sucesso!', 'descricao' => $request->descricao]);
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(['status' => false, 'message' => 'Falha ao atualizar descrição!']);
        }
    }

    public function faseDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $fase_image = FaseObraImagem::where('id', $request->id_fase_imagem)->first();
            $fase_image->delete();
            DB::commit();
            return json_encode(['status' => true, 'message' => 'Imagem ecluida com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(['status' => false, 'message' => 'Falha ao excluir descrição!']);
        }
    }

    public function materiais(Obra $obra)
    {
        $materiais = Material::all()->pluck('nome', 'id')->prepend('Selecione um material', '');
        $materiais_obra = $obra->fases()->join('materiais_obra_fases as mos', 'fase_obras.id', '=', 'mos.fase_obra')->join('materiais as m', 'mos.material', '=', 'm.id')->join('lojas as l', 'mos.loja', '=', 'l.id')->orderBy('mos.data_compra', 'DESC')->select('mos.*', 'm.nome as material_nome', 'fases.nome as fase_nome', 'l.nome as loja_nome')->get();
        $fase_obra = FaseObra::where('obra', $obra->id)->orderBy('inicio_previsto', 'ASC')->join('fases as f', 'fase_obras.fase', '=', 'f.id')->pluck('f.nome', 'fase_obras.id')->prepend('Selecione uma fase', '');
        return view('obras.materias', compact('obra', 'materiais', 'materiais_obra', 'fase_obra'));
    }

    public function buscaLoja(Material $material)
    {
        $lojas = $material->precoLojas()->pluck('lojas.nome', 'lojas.id')->prepend('Selecione uma loja', '');
        $html = "";
        foreach ($lojas as $key => $loja) {
            $html .= "<option value='$key'>$loja</option>";
        }
        return json_encode(['status' => true, 'lojas' => $html]);
    }

    public function buscaPreco(Request $request)
    {
        try {
            $preco = number_format(HistoricoMaterial::where('material', $request->material)->where('loja', $request->loja)->whereDate('data', '<=', $request->data)->first()->preco, 2, ',', '.');
            return json_encode(['status' => true, 'preco' => $preco]);
        } catch (\Exception $e) {
            return json_encode(['status' => false]);
        }
    }

    public function materiaisCreate(Request $request, Obra $obra)
    {
        DB::beginTransaction();
        try {
            $material_obra = new MateriaisObraFase();
            $material_obra->material = $request->material;
            $material_obra->data_compra = $request->data_compra;
            $material_obra->qtd = floatval($request->quantidade);
            $material_obra->loja = $request->loja;
            $material_obra->preco_unitario = floatval($request->preco);
            $material_obra->fase_obra = $request->fase;
            $material_obra->save();
            DB::commit();
            Session::flash('success_message', 'Material adicionado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Falha ao adicionar material!');
        }
        return redirect()->route('obras.materiais', $obra->id);
    }

    public function materiaisDelete(Request $request, Obra $obra)
    {
        $materiaisObraFase = MateriaisObraFase::where('id', $request->materiaisObraFase);
        DB::beginTransaction();
        try {
            $materiaisObraFase->delete();
            DB::commit();
            Session::flash('success_message', 'Material deletado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Falha ao deletar material!');
        }
        return redirect()->route('obras.materiais', ['obra' => $obra->id]);
    }

    public function orcamento(Obra $obra)
    {
        $valores = $this->carregaProjeto();
        return view('obras.orcamento', compact('obra', 'valores'));
    }
}
