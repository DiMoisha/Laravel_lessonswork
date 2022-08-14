<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /***
     * Вывести все новости выбранной категории
     *
     * @param int $categoryId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(int $categoryId)
    {
        return view('news.index',
            [
                'categoryTitle' => $this -> getCategoryTitle($categoryId),
                'newsList' => $this -> getNews($categoryId)
            ]);
    }

    /***
     * Вывести конкретную новость
     *
     * @param int $newsId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $newsId)
    {
        // return current news
        return view('news.show', [
            'news' => $this -> getNewsItem($newsId)
        ]);
    }
}
