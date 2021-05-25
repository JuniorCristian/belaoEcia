<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LojaController extends Controller
{
    public function index()
    {
        return view('lojas.index');
    }

    public function datatable(Request $request)
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

        $columns = array(
            0 => 'nome',
            1 => 'descricao',
            2 => 'tipo',
            3 => 'status',
            4 => 'acoes',
        );

        $totalData = Loja::get()->where("status_db", "1")->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $datatables = Loja::where("status_db", "1")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $datatables =  Loja::where("status_db", "1")
                ->orWhere('descricao', $search)
                ->orWhere('site', $search)
                ->orWhere('telefone', $search)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Loja::where("status_db", "1")
                ->count();
        }



        return DataTables::of($datatables)
            ->editColumn('status', function ($row) {
                if($row['status'] == 1) {
                    return  "<label class=\"label-ativo\">Ativo</label> ";
                }

                if($row['status'] == 0) {
                    return  "<label class=\"label-inativo\">Inativo</label> ";
                }

            })
            ->editColumn('endereco', function ($row){
                return "Rua ".$row->rua.", ".$row->numero." ".$row->cidade."-".$row->uf;
            })
            ->addColumn('acoes', function ($row)  {
                $acoes = "<div class='botoes-datatable'>";

                $acoes .= '<a class="visualizar-datatable"  href="'.route('lojas.show', ['loja'=>$row->id]).'">
                        <i class="fas fa-eye" style="color: #fff"></i></a>';

                $acoes .= '<a class="editar-datatable" href="'.route('lojas.edit', ['loja'=>$row->id]).'">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<a class="excluir-datatable deleta" data-id="'.$row->id.'">
                                <i class="fa fa-trash" style="color: #fff"></i></a>';

                $acoes .= "</div>";

                return $acoes;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function create()
    {
        $loja = new Loja();
        $loja->status = 1;
        return view('lojas.create', compact('loja'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show(Loja $lojas)
    {
        //
    }

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
