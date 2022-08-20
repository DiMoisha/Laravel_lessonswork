<?php

namespace Tests\Feature\Admin;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    /**
     * Тестируем вызов списка заказов
     *
     * @return void
     */
    public function test_admin_order_index_successful_page()
    {
        $response = $this->get(route('admin.orders'));

        $response->assertStatus(200);
    }

    /***
     * Тестируем вызов создания заказа
     *
     * @return void
     */
    public function test_admin_order_create_successful_page()
    {
        $response = $this->get(route('admin.order-create'));

        $response->assertViewIs('admin.order.create')
            ->assertStatus(200);
    }

    /***
     * Тестируем сохранение данных заказа
     *
     * @return void
     */
    public function test_admin_order_create_return_json_page()
    {
        $faker = Factory::create();
        $customerName = $faker->jobTitle();
        $customerTel = $faker->phoneNumber();
        $customerEmail = $faker->email();
        $description = $faker->text(100);

        $data = [
            'customerName'  => $customerName,
            'customerTel'   => $customerTel,
            'customerEmail' => $customerEmail,
            'description'   => $description
        ];

        $response = $this->post(route('admin.order-store'), $data);

        $response->assertJson($data)
            ->assertStatus(200);
    }
}
