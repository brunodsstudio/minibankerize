<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Proposal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface ProposalRepositoryInterface
{
    public function send(Proposal $proposal): array;
    public function getStatus(string $cpf): string;
    public function getProposal(string $cpf): array;

}
    