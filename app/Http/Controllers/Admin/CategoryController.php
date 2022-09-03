<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Queries\CategoryQueryBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    /***
     * Вывести список категорий
     *
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @return Application|Factory|View
     */
    public function index(CategoryQueryBuilder $categoryQueryBuilder): View|Factory|Application
    {
        $categories = $categoryQueryBuilder->getCategories(true);
        return view('admin.category.index',['categories' => $categories]);
    }

    /***
     * Создать категорию
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('admin.category.create');
    }

    /***
     * Сохранение категории в БД
     *
     * @param Request $request
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @return RedirectResponse
     */
    public function store(Request $request, CategoryQueryBuilder $categoryQueryBuilder): RedirectResponse
    {
        $request -> validate(
            [
                'title' => ['required', 'string', 'min:5', 'max:255'],
                'description' => ['string', 'min:5'],
                'tabindex' => ['int', 'min:1', 'max:1264'],
            ]
        );

        $category = $categoryQueryBuilder->create(
            $request -> only(
                [
                    'title',
                    'description',
                    'tabindex'
                ]
            )
        );

        if ($category) {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Категория успешно создана!!');
        }

        return back()->with('error', 'Не удалось создать категорию!');
    }

    /**
     * Редактирование категории
     *
     * @param  Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): Application|Factory|View
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Обновление категории в БД
     *
     * @param Request $request
     * @param Category $category
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @return RedirectResponse
     */
    public function update(Request              $request,
                           Category             $category,
                           CategoryQueryBuilder $categoryQueryBuilder): RedirectResponse
    {
        $request -> validate(
            [
                'title' => ['required', 'string', 'min:5', 'max:255'],
                'description' => ['string', 'min:5'],
                'tabindex' => ['int', 'min:1', 'max:1264'],
            ]
        );

        if ($categoryQueryBuilder->update($category, $request->only(['title', 'description', 'tabindex'])))
        {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Категория успешно обновлена!');
        }

        return back()->with('error', 'Не удалось обновить категорию!');
    }

    /**
     * Удаление категории
     *
     * @param int $categoryId
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @return RedirectResponse
     */
    public function destroy(int $categoryId, CategoryQueryBuilder $categoryQueryBuilder): RedirectResponse
    {
        if ($categoryQueryBuilder->delete($categoryId)) {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Категория успешно удалена!');
        }

        return back()->with('error', 'Не удалось удалить категорию!');
    }

//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param Category $category
//     * @return JsonResponse
//     */
//    public function destroy(Category $category): JsonResponse
//    {
//        dd($category);
//
//        try {
//            $deleted = $category->delete();
//            if($deleted === false) {
//                return \response()->json('error', 400);
//            }
//
//            return \response()->json('ok');
//
//        } catch(\Exception $e) {
//            \Log::error($e->getMessage());
//            return \response()->json('error', 400);
//        }
//    }
}
