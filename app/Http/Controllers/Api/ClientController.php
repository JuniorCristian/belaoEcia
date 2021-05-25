<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente as Client;
use Illuminate\Http\Request;
use App\Http\Resources\ClientRegisterResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientRequest;
use App\Http\Resources\ClientTokenResource;

class ClientController extends Controller
{

    public function listAllClients()
    {
        return Client::all();
    }

    public function show(Client $client)
    {
        return $client;
    }


    public function registerNewClient(ClientRequest $request)
    {

        $client = Client::where('doc_identificacao', $request->doc_identificacao)->firstOrFail();
        $client->update([
            'email' => $request->email,
            'senha' => Hash::make($request->senha)
        ]);

        return new ClientRegisterResource($client);
    }

    public function authenticate(ClientRequest $request)
    {

        $client = Client::where([
            'doc_identificacao' => $request->doc_identificacao,
            'email' => $request->email
        ])->firstOrFail();
        
        if(Hash::check($request->senha, $client->senha))
        {
            $client->tokens()->delete();

            $token = $client->createToken('my-app-token');
            //TODO Create a Request Class for this method.
            return response([
                'status' => 200,
                'data' => $client,
                'token' => $token->plainTextToken
            ], 200);
        }

        return response([
            'status' => '404',
            'message' => 'Não foi possível autenticar o usuário'
        ], 404);
    }
}
