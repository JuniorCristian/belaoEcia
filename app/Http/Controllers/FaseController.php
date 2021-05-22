<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class FaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fases.index');
    }

    public function datatable(Request $request)
    {
        $columns = array(
            0 => 'nome',
            1 => 'descricao',
            2 => 'tipo',
            3 => 'status',
            4 => 'acoes',
        );

        $totalData = Fase::get()->where("status_db", "1")->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $datatables = Fase::where("status_db", "1")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $datatables =  Fase::where("status_db", "1")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Fase::where("status_db", "1")
                ->count();
        }



        return DataTables::of(Fase::where('status_db', 1))
            ->editColumn('status', function ($row) {
                if($row['status'] == 1) {
                    return  "<label class=\"label-ativo\">Ativo</label> ";
                }

                if($row['status'] == 0) {
                    return  "<label class=\"label-inativo\">Inativo</label> ";
                }

            })
            ->editColumn('tipo', function ($row){
                if($row['tipo'] == 1){
                    return  "<label class=\"label-obra\">Obra</label> ";
                }
                if($row['tipo'] == 2){
                    return  "<label class=\"label-reforma\">Reforma</label> ";
                }
                if($row['tipo'] == 3){
                    return  "<label class=\"label-ambas\">Ambas</label> ";
                }
            })
            ->addColumn('acoes', function ($row)  {
                $acoes = "<div class='botoes-datatable'>";

                $acoes .= '<a class="visualizar-datatable" href="'.route('fases.show', ['fase'=>$row->id]).'">
                        <i class="fas fa-eye" style="color: #fff"></i></a>';

                $acoes .= '<a class="editar-datatable" href="'.route('fases.edit', ['fase'=>$row->id]).'">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<a class="excluir-datatable deleta" data-id="'.$row->id.'">
                                <i class="fa fa-trash" style="color: #fff"></i></a>';

                $acoes .= "</div>";

                return $acoes;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fase = new Fase();
        $fase->status = 1;
        return view('fases.create', compact('fase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $fase = new Fase();
            $fase->fill($request->all());
            $fase->status_db = 1;
            $fase->save();
            DB::commit();
            Session::flash('success_message', 'Fase adicionada com sucesso');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error_message', 'Erro ao adicionar Fase');
        }
        return redirect()->route('fases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function show(Fase $fase)
    {
        return view('fases.show', compact('fase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function edit(Fase $fase)
    {
        return view('fases.edit', compact('fase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fase $fase)
    {
        DB::beginTransaction();
        try {
            $fase->fill($request->all());
            $fase->save();
            DB::commit();
            Session::flash('success_message', 'Fase editada com sucesso');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error_message', 'Erro ao editar Fase');
        }
        return redirect()->route('fases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fase $fase)
    {
        DB::beginTransaction();
        try {
            $fase->status_db = 0;
            $fase->save();
            DB::commit();
            Session::flash('success_message', 'Fase excluida com sucesso');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error_message', 'Erro ao excluir Fase');
        }
        return redirect()->route('fases.index');
    }
}
