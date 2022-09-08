<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Feedsource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class FeedsourceQueryBuilder
{
    private Builder $model;

    public  function __construct()
    {
        $this->model = Feedsource::query();
    }

    /***
     * Получаем список источников новостей
     *
     * @param bool $isNeedPagination
     * @return Collection|LengthAwarePaginator
     */
    public function getFeedsources(bool $isNeedPagination = false): Collection|LengthAwarePaginator
    {
        if ($isNeedPagination) {
            return $this
                ->model
                ->orderBy('sourcename')
                ->paginate(config('pagination.admin.feedsources'));
        }
        else {
            return $this
                ->model
                ->orderBy('sourcename')
                ->get();
        }
    }

    /***
     * Получить запись по конкретному ID
     *
     * @param int $feedsourceId
     * @return object|null
     */
    public function getFeedsourceById(int $feedsourceId): ?object
    {
        return $this
            ->model
            ->where($this->model->getModel()->getKeyName() , '=', $feedsourceId)
            ->first();
    }

    /***
     * Создать новую запись
     *
     * @param array $data
     * @return Feedsource|bool
     */
    public function create(array $data): Feedsource|bool
    {
        return Feedsource::create($data);
    }

    /***
     * Редактировать запись
     *
     * @param Feedsource $feedsource
     * @param array $data
     * @return bool
     */
    public function update(Feedsource $feedsource, array $data): bool
    {
        return $feedsource
            ->fill($data)
            ->save();
    }

    /***
     * Удалить запись
     *
     * @param int $feedsourceId
     * @return bool
     */
    public function delete(int $feedsourceId): bool
    {
        $feedsource = $this->getFeedsourceById($feedsourceId);

        if(!empty($feedsource)) {
            return $feedsource->delete();
        }

        return false;
    }
}
