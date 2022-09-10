<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\Social;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialService implements Social
{
    /***
     * @param SocialUser $socialUser
     * @return string
     * @throws \Exception
     */
    public function loginAndGetRedirectUrl(SocialUser $socialUser): string
    {
        $user = User::query()->where('email', '=', $socialUser->getEmail())->first();
        if ($user === null) {
            return route('auth.register');
        }

        if ($socialUser->getName() != null) {
            $user->name = $socialUser->getName();
        }

        if ($socialUser->getAvatar() != null) {
            $user->avatar = $socialUser->getAvatar();
        }

        if ($user->save()) {
            Auth::loginUsingId($user->id);

            return route('account.index');
        }

        throw new \Exception("Did not save user");
    }
}
