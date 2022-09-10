<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedsource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Feedsources\CreateRequest;
use App\Http\Requests\Feedsources\EditRequest;
use App\Queries\FeedsourceQueryBuilder;
use Illuminate\Http\RedirectResponse;
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
     * @param CreateRequest $request
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return RedirectResponse
     */
    public function store(CreateRequest          $request,
                          FeedsourceQueryBuilder $feedsourceQueryBuilder): RedirectResponse
    {
        $feedsource = $feedsourceQueryBuilder->create($request->validated());

        if ($feedsource) {
            return redirect()->route('admin.feedsources.index')
                ->with('success', __('messages.admin.feedsources.create.success'));
        }

        return back()->with('error', __('messages.admin.feedsources.create.fail'));
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
     * @param EditRequest $request
     * @param Feedsource $feedsource
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return RedirectResponse
     */
    public function update(EditRequest            $request,
                           Feedsource             $feedsource,
                           FeedsourceQueryBuilder $feedsourceQueryBuilder): RedirectResponse
    {
        if ($feedsourceQueryBuilder->update($feedsource, $request->validated()))
        {
            return redirect()->route('admin.feedsources.index')
                ->with('success', __('messages.admin.feedsources.update.success'));
        }

        return back()->with('error', __('messages.admin.feedsources.update.fail'));
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
                ->with('success', __('messages.admin.feedsources.destroy.success'));
        }

        return back()->with('error', __('messages.admin.feedsources.destroy.fail'));
    }
}
