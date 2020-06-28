<?php

namespace App\Providers;

use App\Observers\ProjectObserve;
use App\Observers\TaskObserve;
use App\Project;
use App\Task;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Project::observe(ProjectObserve::class);
        Task::observe(TaskObserve::class);
    }
}
