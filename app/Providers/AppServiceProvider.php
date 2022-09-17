<?php

namespace App\Providers;

use App\Queries\CategoryQueryBuilder;
use App\Queries\FeedbackQueryBuilder;
use App\Queries\FeedsourceQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\OrderQueryBuilder;
use App\Queries\UserQueryBuilder;
use App\Services\Contracts\Parser;
use App\Services\Contracts\Social;
use App\Services\ParserService;
use App\Services\SocialService;
use App\Services\UploadService;
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
        $this->app->bind(UserQueryBuilder::class);

        //Services
        $this->app->bind(Parser::class, ParserService::class);
        $this->app->bind(Social::class, SocialService::class);
	    $this->app->bind(UploadService::class);
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
