<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
     use RefreshDatabase;

    public function test_proposal_creation_returns_200()
    {
        $payload = [
            "cpf" => "123123123123",
            "nome" => "Fulano de Tal",
            "data_nascimento" => "2024-10-10",
            "valor_emprestimo" => 1000.00,
            "chave_pix" => "teste@teste.com"
        ];

        $response = $this->postJson('/api/proposals', $payload);
        $response->assertStatus(201)->assertJsonStructure(['message']);
    }

    public function test_proposal_creation_returns_201_if_already_exists()
    {
        $payload = [
            "cpf" => "123123123123",
            "nome" => "Fulano de Tal",
            "data_nascimento" => "2024-10-10",
            "valor_emprestimo" => 1000.00,
            "chave_pix" => "teste@teste.com"
        ];

        $this->postJson('/api/proposals', $payload);
        $response = $this->postJson('/api/proposals', $payload);

        $response->assertStatus(200);
    }

    public function test_proposal_creation_returns_404_on_invalid_route()
    {
        $payload = [
            "cpf" => "123123123123",
            "nome" => "Fulano de Tal",
            "data_nascimento" => "2024-10-10",
            "valor_emprestimo" => 1000.00,
            "chave_pix" => "teste@teste.com"
        ];

        $response = $this->postJson('/api/proposalz', $payload);
        $response->assertStatus(404);
    }

}
