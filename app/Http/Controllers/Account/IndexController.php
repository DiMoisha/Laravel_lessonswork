<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\EditRequest;
use App\Models\User;
use App\Queries\UserQueryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use function back;
use function redirect;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('account.index',
            [
                'pageTitle' => 'HotNews: Личный кабинет'
            ]
        );
    }

    /**
     * Редактирование пользователя
     *
     * @param User $account
     * @return Application|Factory|View
     */
    public function edit(User $account): Application|Factory|View
    {
        return view('account.edit', [
            'account' => $account,
            'pageTitle' => 'HotNews: Редактировать пользователя'
        ]);
    }

    /**
     * Обновление пользователя в БД
     *
     * @param EditRequest $request
     * @param User $account
     * @param UserQueryBuilder $userQueryBuilder
     * @return RedirectResponse
     */
    public function update(EditRequest      $request,
                           User             $account,
                           UserQueryBuilder $userQueryBuilder): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->validated()['password']);

        if ($userQueryBuilder->update($account, $data))
        {
            return redirect()->route('account.index')
                ->with('success', __('messages.admin.users.update.success'));
        }

        return back()->with('error', __('messages.admin.users.update.fail'));
    }
}
