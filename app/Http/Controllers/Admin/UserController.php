<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\EditRequest;
use App\Queries\UserQueryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Вернуть список пользователей
     *
     * @param UserQueryBuilder $userQueryBuilder
     * @return Application|Factory|View
     */
    public function index(UserQueryBuilder $userQueryBuilder): View|Factory|Application
    {
        $users = $userQueryBuilder->getUsers(true);
        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Редактирование пользователя
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user): Application|Factory|View
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Обновление пользователя в БД
     *
     * @param EditRequest $request
     * @param User $user
     * @param UserQueryBuilder $userQueryBuilder
     * @return RedirectResponse
     */
    public function update(EditRequest      $request,
                           User             $user,
                           UserQueryBuilder $userQueryBuilder): RedirectResponse
    {
        if ($userQueryBuilder->update($user, $request->validated()))
        {
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.admin.users.update.success'));
        }

        return back()->with('error', __('messages.admin.users.update.fail'));
    }

    /**
     * Удаление пользователя
     *
     * @param int $userId
     * @param UserQueryBuilder $userQueryBuilder
     * @return RedirectResponse
     */
    public function destroy(int $userId, UserQueryBuilder $userQueryBuilder): RedirectResponse
    {
        if ($userQueryBuilder->delete($userId)) {
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.admin.users.destroy.success'));
        }

        return back()->with('error', __('messages.admin.users.destroy.fail'));
    }
}
