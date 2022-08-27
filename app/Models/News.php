<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    public const DRAFT = 'DRAFT';
    public const ACTIVE = 'ACTIVE';
    public const BLOCKED = 'BLOCKED';

    protected $table = "news";

    private static $selectedFields = ['newsid','categoryid','title','description','author','image','created_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /***
     * Возвращает новости по выбранной категории
     *
     * @param int $categoryId
     * @return Collection
     */
    public function getNews(int $categoryId): Collection
    {
        return DB::table($this->table)
                ->where('categoryid',$categoryId)
                ->orderByDesc('created_at')
                ->get(self::$selectedFields);
    }

    /***
     * Возвращает конкретную новость выбранной категории по ее ID
     *
     * @param int $newsId
     * @return object|null
     */
    public function getNewsById(int $newsId): ?object
    {
        return DB::table($this->table)
                ->select([
                    $this->table.'.newsid',
                    $this->table.'.categoryid',
                    'categories.title as categorytitle',
                    $this->table.'.feedsourceid',
                    'feedsources.sourcename',
                    'feedsources.sourceurl',
                    $this->table.'.title',
                    $this->table.'.description',
                    $this->table.'.author',
                    $this->table.'.image',
                    $this->table.'.status',
                    $this->table.'.created_at'
                ])
                ->join('categories',$this->table.'.categoryid','=','categories.categoryid')
                ->leftJoin('feedsources',$this->table.'.feedsourceid','=','feedsources.feedsourceid')
                ->where('newsid', $newsId)
                ->first();
    }
}
