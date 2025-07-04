<?php
namespace App\Application\UseCases;

use App\Domain\Entities\Proposal;
use App\Domain\Repositories\ProposalRepositoryInterface;

class CreateProposalUseCase
{
    public function __construct(private ProposalRepositoryInterface $repository) {}

    public function execute(array $data): array
    {
        $proposal = new Proposal(
            $data['cpf'],
            $data['nome'],
            $data['data_nascimento'],
            $data['valor_emprestimo'],
            $data['chave_pix']
        );

        return $this->repository->send($proposal);
    }
}
