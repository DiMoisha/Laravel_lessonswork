<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class FeedbackQueryBuilder
{
    private Builder $model;

    public  function __construct()
    {
        $this->model = Feedback::query();
    }

    /***
     * Получаем список сообщений обратной связи
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getFeedback(): Collection|LengthAwarePaginator
    {
        return $this
            ->model
            ->orderBy('created_at')
            ->paginate(config('pagination.admin.feedback'));
    }

    /***
     * Получить запись по конкретному ID
     *
     * @param int $feedbackId
     * @return object|null
     */
    public function getFeedbackById(int $feedbackId): ?object
    {
        return $this
            ->model
            ->where($this->model->getModel()->getKeyName() , '=', $feedbackId)
            ->first();
    }

    /***
     * Создать новую запись
     *
     * @param array $data
     * @return Feedback|bool
     */
    public function create(array $data): Feedback|bool
    {
        return Feedback::create($data);
    }

    /***
     * Редактировать запись
     *
     * @param Feedback $feedback
     * @param array $data
     * @return bool
     */
    public function update(Feedback $feedback, array $data): bool
    {
        return $feedback
            ->fill($data)
            ->save();
    }

    /***
     * Удалить запись
     *
     * @param int $feedbackId
     * @return bool
     */
    public function delete(int $feedbackId): bool
    {
        $feedback = $this->getFeedbackById($feedbackId);

        if(!empty($feedback)) {
            return $feedback->delete();
        }

        return false;
    }
}
