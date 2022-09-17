<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Queries\FeedsourceQueryBuilder;
use App\Services\Contracts\Parser;
use App\Jobs\JobNewsParsing;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Parser $parser
     * @param FeedsourceQueryBuilder $feedsourceQueryBuilder
     * @return string|RedirectResponse
     */
    public function __invoke(Request                $request,
                             Parser                 $parser,
                             FeedsourceQueryBuilder $feedsourceQueryBuilder): string|RedirectResponse
    {
//        INSERT INTO feedsources (sourcename, sourceurl)
//        VALUES('Расследования','https://www.vedomosti.ru/rss/library/investigations'),
//        ('Бизнес','https://www.vedomosti.ru/rss/rubric/business'),
//        ('Экономика','https://www.vedomosti.ru/rss/rubric/economics'),
//        ('Финансы','https://www.vedomosti.ru/rss/rubric/finance'),
//        ('Мнения','https://www.vedomosti.ru/rss/rubric/opinion'),
//        ('Политика','https://www.vedomosti.ru/rss/rubric/politics'),
//        ('Технологии','https://www.vedomosti.ru/rss/rubric/technology'),
//        ('Недвижимость','https://www.vedomosti.ru/rss/rubric/realty'),
//        ('Авто','https://www.vedomosti.ru/rss/rubric/auto')

        $feedsources = $feedsourceQueryBuilder->getFeedsources();
        foreach ($feedsources as $feedsource) {
            \dispatch(new JobNewsParsing($feedsource->sourceurl));
        }

        return "Parsing completed";
    }
}

