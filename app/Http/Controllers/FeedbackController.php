<?php

namespace App\Http\Controllers;

use App\Queries\CategoryQueryBuilder;
use App\Queries\FeedbackQueryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /***
     * Создать сообщение обратной связи
     *
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @return Application|Factory|View
     */
    public function create(CategoryQueryBuilder $categoryQueryBuilder): Application|Factory|View
    {
        $categories = $categoryQueryBuilder->getCategories();

        return view('feedback.create',
            [
                'categories'    => $categories,
                'pageTitle'     => 'HotNews: Обратная связь'
            ]
        );
    }

    /***
     * Отправка сообщения обратной связи
     *
     * @param Request $request
     * @param FeedbackQueryBuilder $feedbackQueryBuilder
     * @return RedirectResponse
     */
    public function store(Request $request,
                          FeedbackQueryBuilder $feedbackQueryBuilder): RedirectResponse
    {
        $request -> validate(
            [
                'sendername'  => ['required', 'string', 'min:2', 'max:255'],
                'senderemail' => ['string', 'min:5', 'max:255'],
                'message'     => ['required', 'min:5'],
            ]
        );

        $feedback = $feedbackQueryBuilder->create(
            $request -> only(
                [
                    'sendername',
                    'senderemail',
                    'message'
                ]
            )
        );

        if ($feedback) {
            return redirect()->route('home.index')
                ->with('success', 'Сообщение отправлено!');
        }

        return back()->with('error', 'Не удалось отправить сообщение!');
    }
}
