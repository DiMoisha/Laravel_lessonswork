<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    private static $selectedFields = ['categoryid', 'title', 'description', 'tabindex', 'created_at'];

    /***
     * Получаем список категорий
     *
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return DB::table($this->table)->get(self::$selectedFields);
    }

    /***
     * Получить запись по конкретному ID
     *
     * @param int $categoryId
     * @return object|null
     */
    public function getCategoryById(int $categoryId): ?object
    {
        return DB::table($this->table)
            ->where('categoryid', $categoryId)
            ->first(self::$selectedFields);
    }

    /***
     * Вывести заголовок категории
     *
     * @param $categoryId
     * @return string
     */
    public function getCategoryTitle($categoryId) : string
    {
        $categoryTitle = 'Категория новостей не существует!';
        $category = $this->getCategoryById($categoryId);

        if(!empty($category))
        {
            //dd($category);
            $categoryTitle = $category->title;
        }

        return $categoryTitle;
    }
}
