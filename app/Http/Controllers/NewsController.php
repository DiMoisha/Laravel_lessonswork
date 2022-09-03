<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Queries\NewsQueryBuilder;
use App\Queries\CategoryQueryBuilder;

class NewsController extends Controller
{
    /***
     * Вывести список новостей по выбранной категории
     *
     * @param int $categoryId
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return Application|Factory|View
     */
    public function index(int $categoryId,
                          CategoryQueryBuilder $categoryQueryBuilder,
                          NewsQueryBuilder $newsQueryBuilder): View|Factory|Application
    {
        $categories = $categoryQueryBuilder->getCategories();
        $categoryTitle = $categoryQueryBuilder->getCategoryTitle($categoryId);
        $newsList = $newsQueryBuilder->getNewsByCategoryId($categoryId);

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
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return Application|Factory|View
     */
    public function show(int $newsId,
                         CategoryQueryBuilder $categoryQueryBuilder,
                         NewsQueryBuilder $newsQueryBuilder): View|Factory|Application
    {
        $categories = $categoryQueryBuilder->getCategories();
        $news = $newsQueryBuilder->getNewsById($newsId);
        $categoryId = !empty($news) ? $news->categoryid : 0;
        $categoryTitle = !empty($news) && !empty($news->category)
                        ? $news->category->title : 'Категория новостей не существует!';

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
