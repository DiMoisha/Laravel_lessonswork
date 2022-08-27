<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /***
     * Получить список заказов
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.order.index');
    }

    /***
     * Создать заказ на выгрузку данных
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Сохранение заказа на выгрузку данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate(
            [
                'customerName'  => ['required', 'string', 'min:5', 'max:255'],
                'customerTel'   => ['required', 'string', 'min:5', 'max:255'],
                'customerEmail' => ['required', 'email', 'min:6', 'max:255'],
                'description'   => 'required'
            ]
        );

//        return response() -> json(
//            $request -> only(
//                [
//                    'customerName',
//                    'customerTel',
//                    'customerEmail',
//                    'description'
//                ]
//            )
//        );

        $file = 'orders/Order-'.strval(gmmktime(0)).'.txt';
        file_put_contents($file, response() -> json(
                $request -> only(
                    [
                        'customerName',
                        'customerTel',
                        'customerEmail',
                        'description'
                    ]
                )
            )
        );

        return @redirect('/admin/orders');
    }
}
