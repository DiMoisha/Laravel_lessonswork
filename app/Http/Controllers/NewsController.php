<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /***
     * Вывести все новости выбранной категории
     *
     * @param int $categoryId
     * @return Application|Factory|View
     */
    public function index(int $categoryId): View|Factory|Application
    {
        $categories = app(Category::class)->getCategories();
        $categoryTitle = app(Category::class)->getCategoryTitle($categoryId);
        $newsList = app(News::class)->getNews($categoryId);

        return view('news.index',
            [
                'categories'    => $categories,
                'categoryId'    => $categoryId,
                'categoryTitle' => $categoryTitle,
                'pageTitle'     => 'HotNews: '.$categoryTitle,
                'newsList'      => $newsList
            ]
        );
    }

    /***
     * Вывести конкретную новость
     *
     * @param int $newsId
     * @return Application|Factory|View
     */
    public function show(int $newsId): View|Factory|Application
    {
        $categories = app(Category::class)->getCategories();
        $news = app(News::class)->getNewsById($newsId);
        $categoryId = !empty($news) ? $news->categoryid : 0;
        $categoryTitle = !empty($news) ? $news->categorytitle : 'Категория новостей не существует!';

        return view('news.show',
            [
                'categories'    => $categories,
                'categoryId'    => $categoryId,
                'pageTitle'     => 'HotNews: '.$categoryTitle,
                'news'          => $news
            ]
        );
    }
}
