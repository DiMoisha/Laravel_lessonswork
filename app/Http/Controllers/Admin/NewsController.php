<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Queries\CategoryQueryBuilder;
use App\Queries\FeedsourceQueryBuilder;
use App\Queries\NewsQueryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /***
     * Вывести список новостей
     *
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return Application|Factory|View
     */
    public function index(NewsQueryBuilder $newsQueryBuilder): View|Factory|Application
    {
        $newsList = $newsQueryBuilder->getNews();
        return view('admin.news.index', ['newsList' => $newsList]);
    }

    /***
     * Создать новость
     *
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return Application|Factory|View
     */
    public function create(CategoryQueryBuilder   $categoryQueryBuilder,
                           FeedsourceQueryBuilder $feedsourceQueryBuilder): Application|Factory|View
    {
        $categories = $categoryQueryBuilder->getCategories();
        $feedsources = $feedsourceQueryBuilder->getFeedsources();
        return view('admin.news.create',
            [
                'categories' => $categories,
                'feedsources' => $feedsources
            ]);
    }

    /***
     * Сохранение новости в БД
     *
     * @param Request $request
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return RedirectResponse
     */
    public function store(Request $request, NewsQueryBuilder $newsQueryBuilder): RedirectResponse
    {
        $request->validate(
            [
                'categoryid' => ['required', 'int', 'min:1'],
                'feedsourceid' => ['int', 'min:1'],
                'title' => ['required', 'string', 'min:3', 'max:255'],
                'description' => ['required', 'min:3'],
                'author' => ['required', 'string', 'min:3', 'max:255'],
                'status' => ['required'],
            ]
        );

        $news = $newsQueryBuilder->create(
            $request->only(
                [
                    'categoryid',
                    'feedsourceid',
                    'title',
                    'description',
                    'author',
                    'image',
                    'status'
                ]
            )
        );

        if ($news) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Новость успешно создана!!');
        }

        return back()->with('error', 'Не удалось создать новость!');
    }

    /**
     * Редактирование новости
     *
     * @param News $news
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return Application|Factory|View
     */
    public function edit(News                   $news,
                         CategoryQueryBuilder   $categoryQueryBuilder,
                         FeedsourceQueryBuilder $feedsourceQueryBuilder): Application|Factory|View
    {
        $categories = $categoryQueryBuilder->getCategories();
        $feedsources = $feedsourceQueryBuilder->getFeedsources();

        return view('admin.news.edit',
            [
                'news' => $news,
                'categories' => $categories,
                'feedsources' => $feedsources
            ]);
    }

    /**
     * Обновление новости в БД
     *
     * @param Request $request
     * @param News $news
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return RedirectResponse
     */
    public function update(Request          $request,
                           News             $news,
                           NewsQueryBuilder $newsQueryBuilder): RedirectResponse
    {
        $request->validate(
            [
                'categoryid' => ['required', 'int', 'min:1'],
                'feedsourceid' => ['int', 'min:1'],
                'title' => ['required', 'string', 'min:3', 'max:255'],
                'description' => ['required', 'min:3'],
                'author' => ['required', 'string', 'min:3', 'max:255'],
                'status' => ['required'],
            ]
        );

        if ($newsQueryBuilder->update($news, $request->only(
            [
                'categoryid',
                'feedsourceid',
                'title',
                'description',
                'author',
                'image',
                'status'
            ]
        ))) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Новость успешно обновлена!');
        }

        return back()->with('error', 'Не удалось обновить новость!');
    }

    /**
     * Удаление новости
     *
     * @param int $newsId
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return RedirectResponse
     */
    public function destroy(int $newsId, NewsQueryBuilder $newsQueryBuilder): RedirectResponse
    {
        if ($newsQueryBuilder->delete($newsId)) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Новость успешно удалена!');
        }

        return back()->with('error', 'Не удалось удалить новость!');
    }
}
