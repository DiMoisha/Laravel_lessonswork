<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class FeedbackController extends Controller
{
    /***
     * Список
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $categories = app(Category::class)->getCategories();

        return view('feedback.index',
            [
                'categories'    => $categories,
                'pageTitle'     => 'HotNews: Обратная связь'
            ]
        );
    }

    /***
    * Создать сообщение обратной связи
    *
    * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $categories = app(Category::class)->getCategories();

        return view('feedback.create',
            [
                'categories'    => $categories,
                'pageTitle'     => 'HotNews: Обратная связь'
            ]
        );
    }

    /**
     * Сохранение заказа на выгрузку данных
     *
     * @param Request $request
     * @return RedirectResponse|Redirector|Application
     */
    public function store(Request $request): Application|RedirectResponse|Redirector
    {
        $request -> validate(
            [
                'senderName'  => ['required', 'string', 'min:5', 'max:255'],
                'message'     => 'required'
            ]
        );

        $path = public_path('feedback');
        $file = $path.'/Feedback-'.strval(gmmktime(0)).'.txt';

        file_put_contents($file, json_encode(
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
