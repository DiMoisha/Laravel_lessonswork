<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CreateRequest;
use App\Queries\OrderQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    /***
     * Вывести список заказов новостей
     *
     * @param OrderQueryBuilder $orderQueryBuilder
     * @return Application|Factory|View
     */
    public function index(OrderQueryBuilder $orderQueryBuilder): View|Factory|Application
    {
        $orders = $orderQueryBuilder->getOrders();
        return view('admin.order.index',['orders' => $orders]);
    }

    /***
     * Создать заказ
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('admin.order.create');
    }

    /***
     * Сохранение заказа в БД
     *
     * @param CreateRequest $request
     * @param OrderQueryBuilder $orderQueryBuilder
     * @return RedirectResponse
     */
    public function store(CreateRequest     $request,
                          OrderQueryBuilder $orderQueryBuilder): RedirectResponse
    {
        $order = $orderQueryBuilder->create($request->validated());

        if ($order) {
            return redirect()->route('admin.orders.index')
                ->with('success', __('messages.admin.orders.create.success'));
        }

        return back()->with('error', __('messages.admin.orders.create.fail'));
    }
}
