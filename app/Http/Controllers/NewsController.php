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
        $categoryTitle = $this -> getCategoryTitle($categoryId);

        return view('news.index',
            [
                'categories'    => $this -> getCategories(),
                'pageTitle'     => 'HotNews: ' . $categoryTitle,
                'categoryTitle' => $categoryTitle,
                'newsList'      => $this -> getNews($categoryId)
            ]
        );
    }

    /***
     * Вывести конкретную новость
     *
     * @param int $newsId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $newsId)
    {
        $newsItem  = $this -> getNewsItem($newsId);
        $categoryId = count($newsItem) > 0 ? $newsItem['categoryId'] : 0;

        // return current news
        return view('news.show',
            [
                'categories'    => $this -> getCategories(),
                'pageTitle'     => 'HotNews: ' . $this -> getCategoryTitle($categoryId),
                'news'          => $newsItem
            ]
        );
    }
}
