<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\EditRequest;
use App\Http\Requests\News\CreateRequest;
use App\Models\News;
use App\Queries\CategoryQueryBuilder;
use App\Queries\FeedsourceQueryBuilder;
use App\Queries\NewsQueryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use function back;
use function redirect;

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
     * @param CreateRequest $request
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return RedirectResponse
     */
    public function store(CreateRequest $request, NewsQueryBuilder $newsQueryBuilder): RedirectResponse
    {
        $news = $newsQueryBuilder->create($request->validated());

        if ($news) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.create.success'));
        }

        return back()->with('error', __('messages.admin.news.create.fail'));
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
     * @param EditRequest $request
     * @param News $news
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return RedirectResponse
     */
    public function update(EditRequest      $request,
                           News             $news,
                           NewsQueryBuilder $newsQueryBuilder): RedirectResponse
    {
        if ($newsQueryBuilder->update($news, $request->validated())) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.update.success'));
        }

        return back()->with('error', __('messages.admin.news.update.fail'));
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
                ->with('success', __('messages.admin.news.destroy.success'));
        }

        return back()->with('error', __('messages.admin.news.destroy.fail'));
    }
}
