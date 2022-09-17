<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

final class UserQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = User::query();
    }

    /***
     * Получаем список пользователей
     *
     * @param bool $isNeedPagination
     * @return Collection|LengthAwarePaginator
     */
    public function getUsers(bool $isNeedPagination = false): Collection|LengthAwarePaginator
    {
        if ($isNeedPagination) {
            return $this->model
                ->orderBy('name')
                ->paginate(config('pagination.admin.users'));
        }
        else {
            return $this->model
                ->orderBy('name')
                ->get();
        }
    }

    /***
     * Получить запись по конкретному ID
     *
     * @param int $userId
     * @return object|null
     */
    public function getUserById(int $userId): ?object
    {
        return $this->model->findOrFail($userId);
    }

    /***
     * Создать новую запись
     *
     * @param array $data
     * @return User|bool
     */
    public function create(array $data): User|bool
    {
        return User::create($data);
    }

    /***
     * Редактировать запись
     *
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function update(User $user, array $data): bool
    {
        return $user
            ->fill($data)
            ->save();
    }

    /***
     * Удалить запись
     *
     * @param int $userId
     * @return bool
     */
    public function delete(int $userId): bool
    {
        $user = $this->getUserById($userId);

        if(!empty($user)) {
            return $user->delete();
        }

        return false;
    }
}
