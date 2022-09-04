<?php

namespace App\Http\Controllers;

use App\Queries\CategoryQueryBuilder;
use App\Queries\FeedbackQueryBuilder;
use App\Http\Requests\Feedback\CreateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
     * @param CreateRequest $request
     * @param FeedbackQueryBuilder $feedbackQueryBuilder
     * @return RedirectResponse
     */
    public function store(CreateRequest        $request,
                          FeedbackQueryBuilder $feedbackQueryBuilder): RedirectResponse
    {
        $feedback = $feedbackQueryBuilder->create($request->validated());

        if ($feedback) {
            return redirect()->route('home.index')
                ->with('success', __('messages.feedback.create.success'));
        }

        return back()->with('error', __('messages.feedback.create.fail'));
    }
}
