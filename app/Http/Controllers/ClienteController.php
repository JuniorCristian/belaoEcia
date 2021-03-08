<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() === true) {
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() === true) {
            return view('clientes.create');
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() === true) {
            $cliente = new Cliente;
            $cliente->nome=$request->nome;
            $cliente->telefone=$request->telefone;
            $cliente->doc_identificacao=$request->doc_identificacao;
            $cliente->cep=$request->cep;
            $cliente->rua=$request->rua;
            $cliente->numero=$request->numero;
            $cliente->complemento=$request->complemento;
            $cliente->bairro=$request->bairro;
            $cliente->cidade=$request->cidade;
            $cliente->uf=$request->uf;
            $cliente->status_db=1;
            if($cliente->save()){
                return redirect()->route('clientes.show');
            }
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::check() === true) {
            $clientes = Cliente::all()->where('status_db', 1);
            return view('clientes.show', ['clientes'=>$clientes]);
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        if (Auth::check() === true) {
            return view('clientes.edit', [
                "cliente"=>$cliente
            ]);
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        if (Auth::check() === true) {
            $cliente->nome=$request->nome;
            $cliente->telefone=$request->telefone;
            $cliente->doc_identificacao=$request->doc_identificacao;
            $cliente->cep=$request->cep;
            $cliente->rua=$request->rua;
            $cliente->numero=$request->numero;
            $cliente->complemento=$request->complemento;
            $cliente->bairro=$request->bairro;
            $cliente->cidade=$request->cidade;
            $cliente->uf=$request->uf;
            if($cliente->save()){
                return redirect()->route('clientes.show');
            }
        }
        return redirect()->route('dashboard.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        if (Auth::check() === true) {
            $cliente->status_db=0;
            if($cliente->save()){
                return redirect()->route('clientes.show');
            }
        }


        return redirect()->route('dashboard.login');
    }
}
