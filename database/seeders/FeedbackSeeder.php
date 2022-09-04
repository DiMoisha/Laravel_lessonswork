<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedback')->insert($this->getData());
    }

    /***
     * @return array
     */
    protected function getData(): array
    {
        $faker = Factory::create(locale: 'ru_RU');
        $data = [];

        for($i=0; $i < 30; $i++) {
            $data[] = [
                'sendername'    => $faker->userName(),
                'senderemail'   => $faker->email(),
                'message'       => $faker->realText(rand(100, 300)),
                'created_at'    => now('Europe/Moscow')
            ];
        }

        return $data;
    }
}
