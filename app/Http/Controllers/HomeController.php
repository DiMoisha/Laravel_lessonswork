<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    /***
     * Главная страница приветствия
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $categories = app(Category::class)->getCategories();

        return view('home.index',
            [
                'isHomeIndexPage'   => true,
                'pageTitle'         => 'Самые горячие новости!',
                'categories'        => $categories
            ]
        );
    }

    /***
     * Страница приветствия из первого урока
     *
     * @return Application|Factory|View
     */
    public function hello(): View|Factory|Application
    {
        return view('home.hello');
    }

    /***
     * Страница "о проекте"
     *
     * @return Application|Factory|View
     */
    public function about(): View|Factory|Application
    {
        return view('home.about');
    }
}
