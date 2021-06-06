<?php

namespace App\Http\Controllers;

use App\Models\HistoricoMaterial;
use App\Models\Loja;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class LojaController extends Controller
{
    public function index()
    {
        return view('lojas.index');
    }

    public function datatable(Request $request)
    {



        return DataTables::of(Loja::all())
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
        DB::beginTransaction();
        try {
            $requestData['nome'] = $request->nome;
            if(strpos($request->site, 'http') && $request->site != null){
                $requestData['site'] = 'https://' . $request->site;
            }elseif($request->site != null){
                $requestData['site'] = $request->site;
            }else{
                $requestData['site'] = env('APP_URL');
            }
            $requestData['telefone'] = $request->telefone;
            $requestData['descricao'] = $request->descricao;
            $requestData['cep'] = $request->cep;
            $requestData['rua'] = $request->rua;
            $requestData['numero'] = $request->numero;
            $requestData['complemento'] = $request->complemento;
            $requestData['bairro'] = $request->bairro;
            $requestData['cidade'] = $request->cidade;
            $requestData['uf'] = $request->uf;
            $requestData['status'] = $request->status;
            $loja = new Loja();
            $loja->create($requestData);
            DB::commit();
            Session::flash('success_message', 'Loja adicionada com sucesso!');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error_message', 'Falha ao adicionar loja!');
        }
        return redirect()->route('lojas.index');
    }

    public function show(Loja $lojas)
    {

    }

    public function edit(Loja $loja)
    {
        return view('lojas.edit', compact('loja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loja  $lojas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loja $loja)
    {
        DB::beginTransaction();
        try {
            $requestData['nome'] = $request->nome;
            if(strpos($request->site, 'http') && $request->site != null){
                $requestData['site'] = 'https://' . $request->site;
            }elseif($request->site != null){
                $requestData['site'] = $request->site;
            }else{
                $requestData['site'] = env('APP_URL');
            }
            $requestData['telefone'] = $request->telefone;
            $requestData['descricao'] = $request->descricao;
            $requestData['cep'] = $request->cep;
            $requestData['rua'] = $request->rua;
            $requestData['numero'] = $request->numero;
            $requestData['complemento'] = $request->complemento;
            $requestData['bairro'] = $request->bairro;
            $requestData['cidade'] = $request->cidade;
            $requestData['uf'] = $request->uf;
            $requestData['status'] = $request->status;
            $loja->update($requestData);
            DB::commit();
            Session::flash('success_message', 'Loja editada com sucesso!');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error_message', 'Falha ao editar loja!');
        }
        return redirect()->route('lojas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loja  $lojas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loja $loja)
    {
        DB::beginTransaction();
        try {
            HistoricoMaterial::where('loja', $loja->id)->delete();
            $loja->delete();
            DB::commit();
            Session::flash('success_message', 'Loja excluida com sucesso');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error_message', 'Erro ao excluir Loja');
        }
        return redirect()->route('lojas.index');
    }
}
