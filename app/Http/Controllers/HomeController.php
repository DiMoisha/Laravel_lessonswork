<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Queries\CategoryQueryBuilder;

class HomeController extends Controller
{
    /***
     * Главная страница приветствия
     *
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @return Application|Factory|View
     */
    public function index(CategoryQueryBuilder $categoryQueryBuilder): View|Factory|Application
    {
        $categories = $categoryQueryBuilder->getCategories();

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
