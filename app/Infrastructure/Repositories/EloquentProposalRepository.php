<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Proposal as DomainProposal;
use App\Domain\Repositories\ProposalRepositoryInterface;
use App\Models\Proposal as EloquentProposal;
use Illuminate\Support\Facades\Http;

class EloquentProposalRepository implements ProposalRepositoryInterface
{
    protected string $apiUrl = 'https://api.exemplo.com';

    public function send(DomainProposal $proposal): array
    {
        EloquentProposal::create([
            'cpf' => $proposal->cpf,
            'nome' => $proposal->nome,
            'data_nascimento' => $proposal->data_nascimento,
            'valor_emprestimo' => $proposal->valor_emprestimo,
            'chave_pix' => $proposal->chave_pix,
            'status' => $proposal->status,
        ]);

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

    public function getStatus(string $cpf): string
    {
        $response = Http::get("{$this->apiUrl}/proposal/status", ['cpf' => $cpf]);
        $status = $response->json()['status'] ?? 'indefinido';

        $proposal = EloquentProposal::where('cpf', $cpf)->first();
        if ($proposal) {
            $proposal->status = $status;
            $proposal->save();
        }

        return $status;
    }
}
