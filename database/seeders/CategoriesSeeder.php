<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    /***
     * @return array
     */
    protected function getData(): array
    {
        return [
            [
                'title'         => 'Общество',
                'description'   => 'Раздел содержит ленту новостей со всего Мира из жизни общества',
                'tabindex'      => 1

            ],
            [
                'title'         => 'Политика',
                'description'   => 'Раздел содержит ленту новостей о политической жизни',
                'tabindex'      => 2
            ],
            [
                'title'         => 'Происшествия',
                'description'   => 'Раздел содержит ленту происшествий и преступлений',
                'tabindex'      => 3
            ],
            [
                'title'         => 'Финансы',
                'description'   => 'Раздел содержит ленту новостей из мира финансов и коммерции',
                'tabindex'      => 4
            ],
            [
                'title'         => 'Спорт',
                'description'   => 'Раздел содержит ленту новостей спорта',
                'tabindex'      => 5
            ],
        ];
    }
}
