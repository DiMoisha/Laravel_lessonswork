<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /***
     * Главная страница приветствия
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('home.index',
            [
                'isHomeIndexPage'   => true,
                'pageTitle'         => 'Самые горячие новости!',
                'categories'        => $this -> getCategories()
            ]
        );
    }

    /***
     * Страница приветствия из первого урока
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function hello()
    {
        return view('home.hello');
    }

    /***
     * Страница "о проекте"
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function about()
    {
        return view('home.about');
    }
}
