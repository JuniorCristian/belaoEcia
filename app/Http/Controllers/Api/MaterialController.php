<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoricoMaterial;
use App\Models\Loja;
use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ['lojas'=>Loja::select('id', 'nome', 'site', 'status')->where('status', 1)->get(), "materiais"=>Material::select('id', 'nome', 'marca', 'sku', 'mpn')->get()];

        return response()->json($response);
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
            $historico_material = new HistoricoMaterial();
            $historico_material->material = $request->material;
            $historico_material->loja = $request->loja;
            $historico_material->preco = $request->preco;
            $historico_material->data = Carbon::now();
            $historico_material->save();
            DB::commit();
            return response()->json(['status'=>true]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['status'=>false, 'error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
