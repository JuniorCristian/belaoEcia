<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use Illuminate\Http\Request;
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

    public function datatable()
    {
        /////// QUERY DO DATATABLE ///////////////
        $query = array();

        array_push($query, array(
            'nome' => 'Fase da Obra 1',
            'descricao'=>'Fase da obra 1',
            'tipo'=>1,
            'status' => 1
        ));

        array_push($query, array(
            'nome' => 'Fase da Obra 2',
            'descricao'=>'Fase da obra 2',
            'tipo'=>2,
            'status' => 0
        ));

        array_push($query, array(
            'nome' => 'Fase da Obra 3',
            'descricao'=>'Fase da obra 3',
            'tipo'=>3,
            'status' => 1
        ));
        /////// FIM QUERY DO DATATABLE ///////////////

        return DataTables::of($query)
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

                $acoes .= '<a class="visualizar-datatable"  href="">
                        <i class="fas fa-eye" style="color: #fff"></i></a>';

                $acoes .= '<a class="editar-datatable" href="'.route('fases.edit', ['fase'=>1]).'">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<form method="POST" action="" style="display:inline">
                            <input name="_method" value="DELETE" type="hidden">
                            '. csrf_field() .'
                            <a class="excluir-datatable deleta" onclick="alertModal (\'Excluir Crud?\',this)">
                                <i class="fa fa-trash" style="color: #fff"></i></a>
                        </form>';

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function show(Fase $fase)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fase  $fase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fase $fase)
    {
        //
    }
}
