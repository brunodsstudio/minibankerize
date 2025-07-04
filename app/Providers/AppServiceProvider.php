<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\ProposalRepositoryInterface;
use App\Infrastructure\Repositories\EloquentProposalRepository;
use App\Jobs\CheckProposalStatusJob;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ProposalRepositoryInterface::class, 
            EloquentProposalRepository::class,
            CheckProposalStatusJob::class);
    }

    public function boot() {}
}
