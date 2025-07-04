<?php
namespace App\Jobs;

use App\Application\UseCases\CheckProposalStatusUseCase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckProposalStatusJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $cpf) {}

    public function handle(CheckProposalStatusUseCase $useCase)
    {
        $status = $useCase->execute($this->cpf);
        \Log::info("Status da proposta para CPF {$this->cpf}: {$status}");
    }
}
