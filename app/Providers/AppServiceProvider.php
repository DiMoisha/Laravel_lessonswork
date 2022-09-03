<?php

namespace App\Providers;

use App\Queries\CategoryQueryBuilder;
use App\Queries\FeedbackQueryBuilder;
use App\Queries\FeedsourceQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\OrderQueryBuilder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryQueryBuilder::class);
        $this->app->bind(NewsQueryBuilder::class);
        $this->app->bind(FeedbackQueryBuilder::class);
        $this->app->bind(FeedsourceQueryBuilder::class);
        $this->app->bind(OrderQueryBuilder::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
