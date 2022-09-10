<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class NewsQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = News::query();
    }

    /***
     * Вывести все новости
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getNews(): Collection|LengthAwarePaginator
    {
        return $this->model
                ->with('category')
                ->with('feedsource')
                ->paginate(config('pagination.admin.news'));
    }

    /***
     * Возвращает новости по выбранной категории
     *
     * @param int $categoryId
     * @return LengthAwarePaginator
     */
    public function getNewsByCategoryId(int $categoryId): LengthAwarePaginator
    {
        return $this->model
                ->where('categoryid', $categoryId)
                ->where('status', News::ACTIVE)
                ->with('category')
                ->with('feedsource')
                ->orderByDesc('created_at')
                ->paginate(config('pagination.public.news'));
    }

    /***
     * Возвращает конкретную новость выбранной категории по ее ID
     *
     * @param int $newsId
     * @return object|null
     */
    public function getNewsById(int $newsId): ?object
    {
        return $this->model
                ->where($this->model->getModel()->getKeyName() , '=', $newsId)
                ->with('category')
                ->with('feedsource')
                ->first();
    }

//    /***
//     * scopeStatus
//     *
//     * @return LengthAwarePaginator
//     */
//    public function scopeStatus(): LengthAwarePaginator
//    {
//        return $this->model
//                ->where('status', News::DRAFT)
//                ->orWhere('status', News::ACTIVE)
//                ->with('category')
//                ->with('feedsource')
//                ->orderByDesc('created_at')
//                ->paginate(config('pagination.news'));
//    }

    /***
     * Создать новую запись
     *
     * @param array $data
     * @return News|bool
     */
    public function create(array $data): News|bool
    {
        return News::create($data);
    }

    /***
     * Редактировать запись
     *
     * @param News $news
     * @param array $data
     * @return bool
     */
    public function update(News $news, array $data): bool
    {
        return $news
            ->fill($data)
            ->save();
    }

    /***
     * Удалить запись
     *
     * @param int $newsId
     * @return bool
     */
    public function delete(int $newsId): bool
    {
        $news = $this->getNewsById($newsId);

        if(!empty($news)) {
            return $news->delete();
        }

        return false;
    }
}
