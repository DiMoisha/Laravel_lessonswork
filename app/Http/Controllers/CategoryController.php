<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Выводит список категорий новостей
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $categories = app(Category::class)->getCategories();

        return view('category.index',
            [
                'categories' => $categories
            ]);
    }
}
