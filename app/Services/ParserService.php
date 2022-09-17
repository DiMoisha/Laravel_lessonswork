<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\Parser;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Queries\CategoryQueryBuilder;
use App\Queries\NewsQueryBuilder;
use Illuminate\Support\Facades\DB;

class ParserService implements Parser
{
    /***
     * @var string
     */
    private string $link;

    /***
     * @param string $link
     * @return $this
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /***
     * @return array
     */
    public function getParseData(): array
    {
        $xml = XmlParser::load($this->link);

        return $xml->parse([
            'title' => [
                'uses' => 'channel.title'
            ],
            'link' => [
                'uses' => 'channel.link'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[category,title,link,guid,description,pubDate]'
            ]
        ]);
    }

    /**
     * @return void
     */
    public function saveParseData(): void
    {
        $data = $this->getParseData();
        $categoryQueryBuilder = new CategoryQueryBuilder();
        $newsQueryBuilder = new NewsQueryBuilder();

        // Получаем источник
        $feedsource = DB::table('feedsources')->where('sourceurl', '=', $this->link)->get();

        // Грузим в БД новости
        foreach ($data['news'] as $news) {
            // Проверяем категорию и добавляем если нет
            $categoryData = [
                'title'       => $news['category'],
                'description' => $data['description'],
            ];
            $category = DB::table('categories')->where('title', '=', $categoryData['title'])->get();
            if (count($category) === 0) {
                $categoryQueryBuilder->create($categoryData);
                $category = DB::table('categories')->where('title', '=', $categoryData['title'])->get();
            }

            $newsData = [
                'categoryid' => $category[0]->categoryid,
                'feedsourceid' => $feedsource[0]->feedsourceid,
                'title' => $news['title'],
                'description' => $news['description'],
                'author' => $news['link'],
                'image' => $data['image'],
                'status' => 'ACTIVE'
            ];
            $existsNews= DB::table('news')
                ->where('categoryid', '=', $categoryData['title'])
                ->where('feedsourceid', '=', $feedsource[0]->feedsourceid)
                ->where('title', '=', $news['title'])
                ->get();
            if (count($existsNews) === 0) {
                $newsQueryBuilder->create($newsData);
            }
        }

//        $e = \explode("/", $this->link);
//        $fileName = end($e);
//        $jsonEncode = json_encode($data);
//
//        Storage::append('news/' . $fileName, $jsonEncode);
    }
}
