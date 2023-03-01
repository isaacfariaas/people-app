<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PessoaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCriacaoDePessoa()
    {
        $dados = [
            'nome' => 'Usuário Teste',
            'cpf' => '12345678901',
            'email' => 'usuario@teste.com',
            'data_nasc' => '1990-01-01',
            'nacionalidade' => 'Brasileiro',
            'telefones' => ['(704) 940-0773', '(21) 94033-0773'],
        ];

        $response = $this->postJson('/api/pessoas', $dados);

        $response->assertStatus(200);
        $this->assertDatabaseHas('pessoas', [
            'nome' => 'Usuário Teste',
            'cpf' => '12345678901',
            'email' => 'usuario@teste.com',
            'data_nasc' => '1990-01-01',
            'nacionalidade' => 'Brasileiro',
        ]);
    }
}
