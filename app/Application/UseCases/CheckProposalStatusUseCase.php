<?php
namespace App\Application\UseCases;

use App\Domain\Repositories\ProposalRepositoryInterface;

class CheckProposalStatusUseCase
{
    public function __construct(private ProposalRepositoryInterface $repository) {}

    public function execute(string $cpf): string
    {
        return $this->repository->getStatus($cpf);
    }
}
