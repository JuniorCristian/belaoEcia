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
            'unidade'=> 1
        ));

        array_push($query, array(
            'nome' => 'Material 2',
            'descricao'=>'Material 2',
            'marca'=>'Marca 2',
            'unidade'=> 2
        ));

        array_push($query, array(
            'nome' => 'Material 3',
            'descricao'=>'Material 3',
            'marca'=>'Marca 3',
            'unidade'=> 3
        ));
        /////// FIM QUERY DO DATATABLE ///////////////

        return DataTables::of($query)
            ->editColumn('unidade', function ($row){
                switch ($row['unidade']){
                    case 1:
                        return "Quilograma";
                    case 2:
                        return "Metro Quadrado";
                    case 3:
                        return "Metro Cúbico";
                    default:
                        return "Sem unidade definida";
                }
            })
            ->addColumn('acoes', function ($row)  {
                $acoes = "<div class='botoes-datatable'>";

                $acoes .= '<a class="visualizar-datatable" data-toggle="ver" data-placement="top" title="Ver"  href="">
                        <i class="fas fa-eye" style="color: #fff"></i></a>';

                $acoes .= '<a class="editar-datatable" data-toggle="editar" data-placement="top" title="Editar" href="'.route('materiais.edit', ['material'=>1]).'">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<form method="POST" action="" style="display:inline">
                            <input name="_method" value="DELETE" type="hidden">
                            '. csrf_field() .'
                            <a class="excluir-datatable deleta" data-toggle="deletar" data-placement="top" title="Deletar" onclick="alertModal (\'Excluir Material?\',this)">
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
