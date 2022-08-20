<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /***
     * Список
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('feedback.index',
            [
                'categories'    => $this -> getCategories(),
                'pageTitle'     => 'HotNews: Обратная связь'
            ]
        );
    }

    /***
    * Создать сообщение обратной связи
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('feedback.create',
            [
                'categories'    => $this -> getCategories(),
                'pageTitle'     => 'HotNews: Обратная связь'
            ]
        );
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
                'senderName'  => ['required', 'string', 'min:5', 'max:255'],
                'message'     => 'required'
            ]
        );

        $file = 'feedback/Feedback-'.strval(gmmktime(0)).'.txt';
        file_put_contents($file, response() -> json(
                $request -> only(
                    [
                        'senderName',
                        'senderEmail',
                        'message'
                    ]
                )
            )
        );

        return @redirect('/');
    }
}
