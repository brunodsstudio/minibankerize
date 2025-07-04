<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Proposal;

interface ProposalRepositoryInterface
{
    public function send(Proposal $proposal): array;
    public function getStatus(string $cpf): string;
}
