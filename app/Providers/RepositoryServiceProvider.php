<?php

namespace App\Providers;

use App\Repositories\Contracts\GatewayAggregationRepositoryInterface;
use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\PlanRepositoryInterface;
use App\Repositories\Contracts\StatisticsRepositoryInterface;
use App\Repositories\Contracts\UserAccountRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\WithdrawalRepositoryInterface;
use App\Repositories\Eloquent\Gateway\EloquentGatewayAggregationRepository;
use App\Repositories\Eloquent\Gateway\EloquentGatewayRepository;
use App\Repositories\Eloquent\Payment\EloquentPaymentRepository;
use App\Repositories\Eloquent\Plan\EloquentPlanRepository;
use App\Repositories\Eloquent\Statistics\EloquentStatisticsRepository;
use App\Repositories\Eloquent\Users\EloquentUserAccountRepository;
use App\Repositories\Eloquent\Users\EloquentUserRepository;
use App\Repositories\Eloquent\Withdrawal\EloquentWithdrawalRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,EloquentUserRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class,EloquentPaymentRepository::class);
        $this->app->bind(StatisticsRepositoryInterface::class,EloquentStatisticsRepository::class);
        $this->app->bind(UserAccountRepositoryInterface::class,EloquentUserAccountRepository::class);
        $this->app->bind(WithdrawalRepositoryInterface::class,EloquentWithdrawalRepository::class);
        $this->app->bind(GatewayRepositoryInterface::class,EloquentGatewayRepository::class);
        $this->app->bind(PlanRepositoryInterface::class,EloquentPlanRepository::class);
        $this->app->bind(GatewayAggregationRepositoryInterface::class,EloquentGatewayAggregationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
