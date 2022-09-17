<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    /***
     * @return array
     */
    protected function getData(): array
    {
        $faker = Factory::create(locale: 'ru_RU');
        $data = [];

        for ($j = 1; $j < 6; $j++) {
            for ($i = 0; $i < 10; $i++) {
                $data[] = [
                    'categoryid'    => $j,
                    'feedsourceid'  => rand(1, 20),
                    'title'         => $faker->realText(rand(20, 50)),
                    'description'   => $faker->realText(rand(150, 300)),
                    'author'        => $faker->userName(),
                    'image'         => $faker->imageUrl(),
                    'status'        => News::DRAFT,
                    'created_at'    => now('Europe/Moscow')
                ];
            }
        }

        return $data;
    }
}
