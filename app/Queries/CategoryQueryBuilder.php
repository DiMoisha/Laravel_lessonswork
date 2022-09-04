<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class CategoryQueryBuilder
{
    private Builder $model;

    public  function __construct()
    {
        $this->model = Category::query();
    }

    /***
     * Получаем список категорий
     *
     * @param bool $isNeedPagination
     * @return Collection|LengthAwarePaginator
     */
    public function getCategories(bool $isNeedPagination = false): Collection|LengthAwarePaginator
    {
        if ($isNeedPagination) {
            return $this
                    ->model
                    ->orderBy('tabindex')
                    ->paginate(config('pagination.admin.categories'));
        }
        else {
            return $this
                    ->model
                    ->orderBy('tabindex')
                    ->get();
        }
    }

    /***
     * Получить запись по конкретному ID
     *
     * @param int $categoryId
     * @return object|null
     */
    public function getCategoryById(int $categoryId): ?object
    {
        return $this
                ->model
                ->where($this->model->getModel()->getKeyName() , '=', $categoryId)
                ->first();
    }

    /***
     * Вывести заголовок категории
     *
     * @param $categoryId
     * @return string
     */
    public function getCategoryTitle($categoryId): string
    {
        $category = $this->getCategoryById($categoryId);

        if(!empty($category)) {
            return $category->title;
        }

        return 'Категория новостей не существует!';
    }

    /***
     * Создать новую запись
     *
     * @param array $data
     * @return Category|bool
     */
    public function create(array $data): Category|bool
    {
        return Category::create($data);
    }

    /***
     * Редактировать запись
     *
     * @param Category $category
     * @param array $data
     * @return bool
     */
    public function update(Category $category, array $data): bool
    {
        return $category
                ->fill($data)
                ->save();
    }

    /***
     * Удалить запись
     *
     * @param int $categoryId
     * @return bool
     */
    public function delete(int $categoryId): bool
    {
        $category = $this->getCategoryById($categoryId);

        if(!empty($category)) {
            return $category->delete();
        }

        return false;
    }
}
