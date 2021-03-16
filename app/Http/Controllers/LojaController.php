<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lojas.show');
    }

    public function datatable()
    {
/////// QUERY DO DATATABLE ///////////////
        $query = array();

        array_push($query, array(
            'nome' => 'Loja 1',
            'endereco'=>'Rua Teste, 550 Piraquara-PR',
            'status' => 1
        ));

        array_push($query, array(
            'nome' => 'Loja 2',
            'endereco'=>'Rua Teste, 550 Piraquara-PR',
            'status' => 0
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
            ->addColumn('acoes', function ($row)  {
                $acoes = "<div class='botoes-datatable'>";

                $acoes .= '<a class="visualizar-datatable"  href="">
                        <i class="fas fa-eye" style="color: #fff"></i></a>';

                $acoes .= '<a class="editar-datatable" href="'.route('lojas.edit', ['loja'=>1]).'">
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
        $loja = new Loja();
        $loja->status = 1;
        return view('lojas.create', compact('loja'));
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
     * @param  \App\Models\Loja  $lojas
     * @return \Illuminate\Http\Response
     */
    public function show(Loja $lojas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loja  $loja
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $loja = new Loja();
        $loja->id = 1;
        $loja->nome="Loja 1";
        $loja->descricao="Descrição da loja";
        $loja->site="www.loja1.com.br";
        $loja->telefone="41984699082";
        $loja->cep="83.306-120";
        $loja->rua="Rua da Loja";
        $loja->numero="1";
        $loja->complemento="";
        $loja->bairro="Lojinha";
        $loja->cidade="Piraquara";
        $loja->uf="PR";
        $loja->status=1;
        return view('lojas.edit', compact('loja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loja  $lojas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loja $lojas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loja  $lojas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loja $lojas)
    {
        //
    }
}
