<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Queries\CategoryQueryBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\Categories\CreateRequest;
use App\Http\Requests\Categories\EditRequest;
use function back;
use function redirect;

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
     * @param CreateRequest $request
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @return RedirectResponse
     */
    public function store(CreateRequest $request, CategoryQueryBuilder $categoryQueryBuilder): RedirectResponse
    {
        $category = $categoryQueryBuilder->create($request->validated());

        if ($category) {
            return redirect()->route('admin.categories.index')
                ->with('success', __('messages.admin.categories.create.success'));
        }

        return back()->with('error', __('messages.admin.categories.create.fail'));
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
     * @param EditRequest $request
     * @param Category $category
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @return RedirectResponse
     */
    public function update(EditRequest          $request,
                           Category             $category,
                           CategoryQueryBuilder $categoryQueryBuilder): RedirectResponse
    {
        if ($categoryQueryBuilder->update($category, $request->validated()))
        {
            return redirect()->route('admin.categories.index')
                ->with('success', __('messages.admin.categories.update.success'));
        }

        return back()->with('error', __('messages.admin.categories.update.fail'));
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
                ->with('success', __('messages.admin.categories.destroy.success'));
        }

        return back()->with('error', __('messages.admin.categories.destroy.fail'));
    }


//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param Category $category
//     * @return JsonResponse
//     */
//    public function destroy(Category $category): JsonResponse
//    {
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
