<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
     /**
     * Главная страница админки
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function __invoke(Request $request): Application|Factory|View
    {
        return view('admin.index');
    }
}
