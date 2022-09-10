<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class OrderQueryBuilder
{
    private Builder $model;

    public  function __construct()
    {
        $this->model = Order::query();
    }

    /***
     * Получаем список заказов новостей
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getOrders(): Collection|LengthAwarePaginator
    {
        return $this
            ->model
            ->orderBy('created_at')
            ->paginate(config('pagination.admin.orders'));
    }

    /***
     * Получить запись по конкретному ID
     *
     * @param int $orderId
     * @return object|null
     */
    public function getOrderById(int $orderId): ?object
    {
        return $this
            ->model
            ->where($this->model->getModel()->getKeyName() , '=', $orderId)
            ->first();
    }

    /***
     * Создать новую запись
     *
     * @param array $data
     * @return Order|bool
     */
    public function create(array $data): Order|bool
    {
        return Order::create($data);
    }

    /***
     * Редактировать запись
     *
     * @param Order $order
     * @param array $data
     * @return bool
     */
    public function update(Order $order, array $data): bool
    {
        return $order
            ->fill($data)
            ->save();
    }

    /***
     * Удалить запись
     *
     * @param int $orderId
     * @return bool
     */
    public function delete(int $orderId): bool
    {
        $order = $this->getOrderById($orderId);

        if(!empty($order)) {
            return $order->delete();
        }

        return false;
    }
}
