<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
        /** 1. Добавить в родительский контроллер
        методы для хранения данных, которые будет возвращать массивы. Массивы должны
        содержать информацию о категориях
        новостей (минимум 5), и новостях (минимум 4 для каждой категории).
     */

    private $categories = [];   // В этом свойстве будем хранить список категорий новостей
    private $news = [];         // В этом свойстве будем хранить список новостей

    /***
     * Создает список категорий новостей
     *
     * @return void
     */
    private function setCategories() : void
    {
        $this -> categories = [
            [
                'categoryId' => 1,
                'title'      => 'Общество'
            ],
            [
                'categoryId' => 2,
                'title'      => 'Политика'
            ],
            [
                'categoryId' => 3,
                'title'      => 'Происшествия'
            ],
            [
                'categoryId' => 4,
                'title'      => 'Финансы'
            ],
            [
                'categoryId' => 5,
                'title'      => 'Спорт'
            ],
        ];
    }

    /***
     * Создает список новостей по категориям
     *
     * @return void
     */
    private function setNews() : void
    {
        $faker = Factory::create();

        $this -> news = [
            [
                'newsId'        => 1,
                'categoryId'    => 1,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'В Нижнем Тагиле представили электробус',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 2,
                'categoryId'    => 1,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'В Бразилии родилась девочка-мутант',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 3,
                'categoryId'    => 1,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'США испытали баллистическую ракету',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 4,
                'categoryId'    => 1,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Apple представил новый iPhone',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 5,
                'categoryId'    => 2,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Байден обвинил Трампа в беспорядках в Белом Доме',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 6,
                'categoryId'    => 2,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Внеочередная сессия Совбеза ООН созвана по инициативе Украины',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 7,
                'categoryId'    => 2,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Чавушоглу аннонсировал сессию "Великого Турана"',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 8,
                'categoryId'    => 2,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Медведев подписал указ чтобы россияне держались пока нет денег',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 9,
                'categoryId'    => 3,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'В Буйнакске проводится контртеррористическая операция',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 10,
                'categoryId'    => 3,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'В столичном аэропорту задержали сторонника ИГИЛ',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 11,
                'categoryId'    => 3,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'В Питере на ст.метро "Василеостровская" ограбили старушку',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 12,
                'categoryId'    => 3,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'В Москве 10 кавкацев избили москвича на автобусной остановке',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 13,
                'categoryId'    => 4,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Рубль укрепился до 80руб за доллар на открытии торгов ММВБ',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 14,
                'categoryId'    => 4,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Золото торгуется на уровне 100$ за унцию',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 15,
                'categoryId'    => 4,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Нефть марки Брент опустилась ниже 25$ за баррель',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 16,
                'categoryId'    => 4,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Блумберг заявил о падениии акций NasDaq на 1.3%',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 17,
                'categoryId'    => 5,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => '"витязь" Поветкин проиграл нокаутом',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 18,
                'categoryId'    => 5,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Спартак обыграл грозненский Ахмат',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 19,
                'categoryId'    => 5,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Усик нокаутировал Джошуа',
                'created_at'    => now('Europe/Moscow')
            ],
            [
                'newsId'        => 20,
                'categoryId'    => 5,
                'title'         => $faker->jobTitle(),
                'author'        => $faker->userName(),
                'description'   => 'Теннисистка Гарсиа вышла в полуфинал ЧМ-22',
                'created_at'    => now('Europe/Moscow')
            ]
        ];
    }

    /***
     * Возвращает список категорий новостей
     *
     * @return array
     */
    public function getCategories() : array
    {
        if (count($this -> categories) < 1)
            $this -> setCategories();

        return $this -> categories;
    }

    /***
     * Вывести заголовок категории
     *
     * @param $categoryId
     * @return string
     */
    public function getCategoryTitle($categoryId) : string
    {
        if (count($this -> categories) < 1)
            $this -> setCategories();

        foreach ($this -> categories as $category)
        {
            if ($category['categoryId'] == $categoryId)
                return $category['title'];
        }

        return 'Такая категория новостей не существует!';
    }

    /***
     * Возвращает новости по выбранной категории
     *
     * @param int $categoryId
     * @return array
     */
    public function getNews(int $categoryId = 1) : array
    {
        if (count($this -> news) < 1)
            $this -> setNews();

        $newsByCategory = [];

        foreach ($this -> news as $item)
        {
            if ($item['categoryId'] == $categoryId)
                $newsByCategory[] = $item;
        }

        return $newsByCategory;
    }

    /***
     * Возвращает конкретную новость выбранной категории по ее ID
     *
     * @param int $newsId
     * @return array
     */
    public function getNewsItem(int $newsId) : array
    {
        if (count($this -> news) < 1)
            $this -> setNews();

        foreach ($this -> news as $item)
        {
            if ($item['newsId'] == $newsId)
                return $item;
        }

        return [];
    }
}
