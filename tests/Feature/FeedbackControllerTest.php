<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedbackControllerTest extends TestCase
{
    /**
     * Тестируем вызов списка отзывов
     *
     * @return void
     */
    public function test_feedback_index_successful_page()
    {
        $response = $this->get(route('feedback.index'));

        $response->assertStatus(200);
    }

    /***
     * Тестируем вызов обратной связи
     *
     * @return void
     */
	public function test_feedback_create_successful_page()
	{
		$response = $this->get(route('feedback.create'));

		$response->assertViewIs('feedback.create')
			->assertStatus(200);
	}

    /***
     * Тестируем сохранение данных обратной связи
     *
     * @return void
     */
	public function test_feedback_create_return_json_page()
	{
		$faker = Factory::create();
		$senderName = $faker->jobTitle();
        $senderEmail = $faker->email();
        $message = $faker->text(100);

		$data = [
			'senderName'    => $senderName,
            'senderEmail'   => $senderEmail,
            'message'       => $message
		];

		$response = $this->post(route('feedback.store'), $data);

		$response->assertJson($data)
			->assertStatus(200);
	}
}
