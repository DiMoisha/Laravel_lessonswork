<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Queries\FeedbackQueryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FeedbackController extends Controller
{
    /***
     * Вывести список сообщений обратной связи
     *
     * @param FeedbackQueryBuilder $feedbackQueryBuilder
     * @return Application|Factory|View
     */
    public function index(FeedbackQueryBuilder $feedbackQueryBuilder): View|Factory|Application
    {
        $feedbackList = $feedbackQueryBuilder->getFeedback();
        return view('admin.feedback.index',['feedbackList' => $feedbackList]);
    }

    /***
     * Информация по конкретному сообщению
     *
     * @param int $feedbackId
     * @param FeedbackQueryBuilder $feedbackQueryBuilder
     * @return Application|Factory|View
     */
    public function show(int $feedbackId, FeedbackQueryBuilder $feedbackQueryBuilder): View|Factory|Application
    {
        $feedback = $feedbackQueryBuilder->getFeedbackById($feedbackId);
        return view('admin.feedback.show',['feedback' => $feedback]);
    }
}
