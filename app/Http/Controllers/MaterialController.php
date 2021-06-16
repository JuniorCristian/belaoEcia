<?php

namespace App\Http\Controllers;

use App\Models\HistoricoMaterial;
use App\Models\Loja;
use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

        return DataTables::of(Material::all())
            ->editColumn('unidade', function ($row) {
                switch ($row['unidade']) {
                    case 1:
                        return "Quilograma";
                    case 2:
                        return "Metro Quadrado";
                    case 3:
                        return "Metro Cúbico";
                    case 4:
                        return "Unidade";
                    default:
                        return "Sem unidade definida";
                }
            })
            ->addColumn('acoes', function ($row) {
                $acoes = "<div class='botoes-datatable'>";

                $acoes .= '<a class="visualizar-datatable" data-toggle="ver" data-placement="top" title="Ver"  href="">
                        <i class="fas fa-eye" style="color: #fff"></i></a>';

                $acoes .= '<a class="editar-datatable" data-toggle="editar" data-placement="top" title="Editar" href="' . route('materiais.edit', ['material' => $row->id]) . '">
                        <i class="fa fa-edit" style="color: #fff"></i></a>';

                $acoes .= '<a class="excluir-datatable deleta" data-id="' . $row->id . '">
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
        $material = new Material();
        $lojas = Loja::all()->pluck('nome', 'id');
        $lojas->prepend('Selecione uma Loja', '');
        $lista_materiais = [];
        return view("materiais.create", compact("material", "lista_materiais", "lojas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData['nome'] = $request->nome;
        $requestData['marca'] = $request->marca;
        $requestData['unidade'] = $request->unidade;
        $requestData['sku'] = $request->sku;
        $requestData['mpn'] = $request->mpn;
        $requestData['descricao'] = $request->descricao;
        DB::beginTransaction();
        try {
            $material = new Material();
            $material->create($requestData);
            DB::commit();
            Session::flash('success_message', 'Material adicionado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Falha ao adicionar Material!');
        }
        return redirect()->route('materiais.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        $lista_materiais = $material->lista()->orderBy('data')->get();
        $lojas = Loja::all()->pluck('nome', 'id');
        $lojas->prepend('Selecione uma Loja', '');
        return view('materiais.edit', compact('material', 'lista_materiais', 'lojas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        DB::beginTransaction();
        try{
            $requestData['nome'] = $request->nome;
            $requestData['marca'] = $request->marca;
            $requestData['unidade'] = $request->unidade;
            $requestData['sku'] = $request->sku;
            $requestData['mpn'] = $request->mpn;
            $requestData['descricao'] = $request->descricao;
            HistoricoMaterial::where('material', $material->id)->delete();
            foreach ($request->preco as $key=>$p){
                $historia_material = new HistoricoMaterial();
                $historia_material->material = $material->id;
                $historia_material->preco = floatval(str_replace(',', '.', $p));
                $historia_material->data = $request->data[$key];
                $historia_material->loja = $request->loja[$key];
                $historia_material->save();
            }
            $material->update($requestData);
            DB::commit();
            Session::flash('success_message', 'Material atualizado com sucesso!');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error_message', 'Erro ao atualizar material!');
        }
        return redirect()->route('materiais.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        DB::transaction(function () use ($material) {
            try {
                $material->delete();
                Session::flash('success_message', 'Material excluido com sucesso!');
            }catch (\Exception $e){
                Session::flash('error_message', 'Falha ao excluir material!');
            }
        });
        return redirect()->route('materiais.index');
    }
}
