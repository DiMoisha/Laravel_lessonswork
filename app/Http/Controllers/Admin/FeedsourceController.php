<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedsource;
use App\Http\Controllers\Controller;
use App\Queries\FeedsourceQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FeedsourceController extends Controller
{
    /***
     * Вывести список источников новостей
     *
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return Application|Factory|View
     */
    public function index(FeedsourceQueryBuilder $feedsourceQueryBuilder): View|Factory|Application
    {
        $feedsources = $feedsourceQueryBuilder->getFeedsources(true);
        return view('admin.feedsource.index',['feedsources' => $feedsources]);
    }

    /***
     * Создать источник новости
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('admin.feedsource.create');
    }

    /***
     * Сохранение источника в БД
     *
     * @param Request $request
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return RedirectResponse
     */
    public function store(Request $request, FeedsourceQueryBuilder $feedsourceQueryBuilder): RedirectResponse
    {
        $request -> validate(
            [
                'sourcename' => ['required', 'string', 'min:5', 'max:255'],
                'sourceurl' => ['string', 'min:5'],
            ]
        );

        $feedsource = $feedsourceQueryBuilder->create($request -> only(['sourcename', 'sourceurl']));

        if ($feedsource) {
            return redirect()->route('admin.feedsources.index')
                ->with('success', 'Источник успешно создан!!');
        }

        return back()->with('error', 'Не удалось создать источник!');
    }

    /**
     * Редактирование источника новости
     *
     * @param  Feedsource $feedsource
     * @return Application|Factory|View
     */
    public function edit(Feedsource $feedsource): Application|Factory|View
    {
        return view('admin.feedsource.edit', ['feedsource' => $feedsource]);
    }

    /**
     * Обновление источника новости в БД
     *
     * @param Request $request
     * @param Feedsource $feedsource
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return RedirectResponse
     */
    public function update(Request                $request,
                           Feedsource             $feedsource,
                           FeedsourceQueryBuilder $feedsourceQueryBuilder): RedirectResponse
    {
        $request -> validate(
            [
                'sourcename' => ['required', 'string', 'min:5', 'max:255'],
                'sourceurl' => ['string', 'min:5'],
            ]
        );

        if ($feedsourceQueryBuilder->update($feedsource, $request -> only(['sourcename', 'sourceurl'])))
        {
            return redirect()->route('admin.feedsources.index')
                ->with('success', 'Источник успешно обновлен!');
        }

        return back()->with('error', 'Не удалось обновить источник!');
    }

    /**
     * Удаление источника новости
     *
     * @param int $feedsourceId
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return RedirectResponse
     */
    public function destroy(int $feedsourceId, FeedsourceQueryBuilder $feedsourceQueryBuilder): RedirectResponse
    {
        if ($feedsourceQueryBuilder->delete($feedsourceId)) {
            return redirect()->route('admin.feedsources.index')
                ->with('success', 'Источник успешно удален!');
        }

        return back()->with('error', 'Не удалось удалить источник!');
    }
}
