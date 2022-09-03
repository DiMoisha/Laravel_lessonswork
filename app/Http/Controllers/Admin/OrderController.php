<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Queries\OrderQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @param OrderQueryBuilder $orderQueryBuilder
     * @return RedirectResponse
     */
    public function store(Request $request, OrderQueryBuilder $orderQueryBuilder): RedirectResponse
    {
        $request -> validate(
            [
                'sourceemail' => ['required', 'string', 'min:5', 'max:255'],
                'customername' => ['required', 'string', 'min:5', 'max:255'],
                'customertel' => ['string', 'min:5', 'max:255'],
                'customeremail' => ['string', 'min:5', 'max:255'],
                'description' => ['required', 'min:5'],
            ]
        );

        $order = $orderQueryBuilder->create(
            $request -> only(
                [
                    'sourceemail',
                    'customername',
                    'customertel',
                    'customeremail',
                    'description'
                ]
            )
        );

        if ($order) {
            return redirect()->route('admin.orders.index')
                ->with('success', 'Заказ успешно создан!!');
        }

        return back()->with('error', 'Не удалось создать заказ!');
    }
}
