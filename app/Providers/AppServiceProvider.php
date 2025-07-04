<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\ProposalRepositoryInterface;
use App\Infrastructure\Repositories\ExternalProposalRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProposalRepositoryInterface::class, ExternalProposalRepository::class);
    }

    public function boot() {}
}
