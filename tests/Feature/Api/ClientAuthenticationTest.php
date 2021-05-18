<?php

namespace Tests\Feature\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cliente as Client;
use Illuminate\Support\Facades\Hash;

class ClientAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    private $client;

    public function setUp() :void 
    {
        parent::setUp();
        $this->client = (Client::factory(1)->create())[0];
    }

    public function test_can_register_a_client_and_set_password_successfully()
    {
        $dados = [
            'doc_identificacao' => $this->client->doc_identificacao,
            'email' => 'salve@gmail.com',
            'senha' => 'supersecretpassword'
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json'
        ])->json('post','/api/clients/register', $dados);

        $response->assertStatus(200);

        $response->assertJson([
            'status' => 201,
            'data' => [
                'nome' => $this->client->nome,
                'email' => 'salve@gmail.com',
                'doc_identificacao' => $this->client->doc_identificacao
            ]
        ]);
        
    }

    public function test_can_authenticate_as_a_valid_user_successfully()
    {
        $dados = [
            'doc_identificacao' => $this->client->doc_identificacao,
            'email' => 'salve@gmail.com',
            'senha' => 'supersecretpassword'
        ];

        $this->withHeaders([
            'Content-Type' => 'application/json'
        ])->json('post','/api/clients/register', $dados);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json'
        ])->json('post','/api/clients/authenticate', $dados);

        $response->assertStatus(200);
    }
}
