<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Proposal;
use App\Domain\Repositories\ProposalRepositoryInterface;
use Illuminate\Support\Facades\Http;

class ExternalProposalRepository implements ProposalRepositoryInterface
{
    protected string $apiUrl = 'https://api.exemplo.com';

    public function sendOld(Proposal $proposal): array
    {
        $response = Http::post("{$this->apiUrl}/proposal", [
            'cpf' => $proposal->cpf,
            'nome' => $proposal->nome,
            'data_nascimento' => $proposal->data_nascimento,
            'valor_emprestimo' => $proposal->valor_emprestimo,
            'chave_pix' => $proposal->chave_pix,
            'status' => $proposal->status,
        ]);

        return $response->json();
    }

    public function getStatusOld(string $cpf): string
    {
        $response = Http::get("{$this->apiUrl}/proposal/status", ['cpf' => $cpf]);
        return $response->json()['status'] ?? 'indefinido';
    }
}
