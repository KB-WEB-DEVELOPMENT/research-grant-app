<?php

namespace App\Providers;

use App\Jobs\CreateFinanceJob;
use App\Jobs\UpdateGovernanceJob;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
		$this->app->bindMethod(
				[CreateFinanceJob::class, 'handle'],		   
				function (CreateFinanceJob $createFinanceJob) {
					return $createFinanceJob->handle();
				});
				
		$this->app->bindMethod(
				[UpdateGovernanceJob::class, 'handle'],			   
				function (UpdateGovernanceJob $updateGovernanceJob) {			
					return $updateGovernanceJob->handle();
				});
    }
}
