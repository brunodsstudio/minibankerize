<?php
namespace App\Jobs;

use App\Application\UseCases\CheckProposalStatusUseCase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\Middleware\RateLimited;

class CheckProposalStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $cpf) {}

    public function handle(CheckProposalStatusUseCase $useCase)
    {
        $status = $useCase->execute($this->cpf);
        Mail::to($this->user)->send(new NewUserNotification($this->user));
        
    }
}
