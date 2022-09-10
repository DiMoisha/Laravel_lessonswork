<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Queries\CategoryQueryBuilder;
use App\Queries\FeedsourceQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Services\Contracts\Parser;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Parser $parser
     * @param CategoryQueryBuilder $categoryQueryBuilder
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @param NewsQueryBuilder $newsQueryBuilder
     * @return RedirectResponse
     */
    public function __invoke(Request                $request,
                             Parser                 $parser,
                             CategoryQueryBuilder   $categoryQueryBuilder,
                             FeedsourceQueryBuilder $feedsourceQueryBuilder,
                             NewsQueryBuilder       $newsQueryBuilder)
    {
        $load = $parser->setLink("https://news.yandex.ru/music.rss")->getParseData();

        // Проверяем категорию и добавляем если нет
        $categoryData = [
            'title' => 'Музыка',
            'description' => 'Новости из мира музыки',
        ];
        $isExistsCategory = DB::table('categories')->where('title', '=', 'Музыка')->get();
        if (count($isExistsCategory) === 0) {
            $categoryQueryBuilder->create($categoryData);
            $category = DB::table('categories')->where('title', '=', 'Музыка')->get();
            if (count($category) === 0)
            {
                return back()->with('error', __('messages.admin.categories.create.fail'));
            }
        }

        // Проверяем источник и добавляем если нет
        $feedsourceData = [
            'sourcename' => $load['title'],
            'sourceurl' => $load['link'],
        ];
        $isExistsFeedsource = DB::table('feedsources')
            ->where('sourcename', '=', $load['title'])->get();
        if (count($isExistsFeedsource) === 0) {
            $feedsourceQueryBuilder->create($feedsourceData);
            $feedsource = DB::table('feedsources')
                ->where('sourcename', '=', $load['title'])->get();
            if (count($feedsource) === 0)
            {
                return back()->with('error', __('messages.admin.feedsources.create.fail'));
            }
        }

        // Грузим в БД новости
        foreach ($load['news'] as $news) {
            $newsData = [
                'categoryid' => $category[0]->categoryid,
                'feedsourceid' => $feedsource[0]->feedsourceid,
                'title' => $news['title'],
                'description' => $news['description'],
                'author' => $news['link'],
                'image' => $load['image'],
                'status' => 'ACTIVE'
            ];
            $newsQueryBuilder->create($newsData);
        }

        dd($load);
    }
}
