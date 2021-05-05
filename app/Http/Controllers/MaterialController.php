<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("materiais.index");
    }

    public function datatable()
    {
        /////// QUERY DO DATATABLE ///////////////
        $query = array();

        array_push($query, array(
            'nome' => 'Material 1',
            'descricao'=>'Material 1',
            'marca'=>'Marca 1',
            'unidade'=>'Kg'
        ));

        array_push($query, array(
            'nome' => 'Material 2',
            'descricao'=>'Material 2',
            'marca'=>'Marca 2',
            'unidade'=>'M²'
        ));

        array_push($query, array(
            'nome' => 'Material 3',
            'descricao'=>'Material 3',
            'marca'=>'Marca 3',
            'unidade'=>'M³'
        ));
        /////// FIM QUERY DO DATATABLE ///////////////

        return DataTables::of($query)
            ->editColumn('unidade', function ($row){
                switch ($row){
                    case 1:
                        return "Kg";
                    case 2:
                        return "M²";
                    case 3:
                        return "M³";
                }
            })
            ->addColumn('acoes', function ($row)  {
                $acoes = "<div class='botoes-datatable'>";

                $acoes .= '<a class="visualizar-datatable"  href="">
                        <i class="fas fa-eye" style="color: #fff"></i></a>';

                $acoes .= '<a class="editar-datatable" href="'.route('materiais.edit', ['material'=>1]).'">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<form method="POST" action="" style="display:inline">
                            <input name="_method" value="DELETE" type="hidden">
                            '. csrf_field() .'
                            <a class="excluir-datatable deleta" onclick="alertModal (\'Excluir Material?\',this)">
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
        $material = new Material();
        return view("materiais.create", compact("material"));
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
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('materiais.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}
