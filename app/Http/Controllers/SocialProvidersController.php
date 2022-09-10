<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use App\Services\Contracts\Social;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class SocialProvidersController extends Controller
{
    /***
     * @param string $driver
     * @return SymfonyRedirectResponse|RedirectResponse
     */
    public function redirect(string $driver): SymfonyRedirectResponse | RedirectResponse
    {
        return Socialite::driver($driver)->redirect();
    }

    /***
     * @param string $driver
     * @param Social $social
     * @return Redirector|Application|RedirectResponse
     */
    public function callback(string $driver, Social $social): Redirector | Application |RedirectResponse
    {
        return redirect(
            $social->loginAndGetRedirectUrl(Socialite::driver($driver)->user())
        );
    }
}
