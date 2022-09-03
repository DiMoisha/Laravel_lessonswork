<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * Index page(home page) test status
     *
     * @return void
     */
    public function test_home_index_successful_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Helloo page test status
     *
     * @return void
     */
    public function test_home_hello_successful_page()
    {
        $response = $this->get(route('home.hello'));

        $response->assertStatus(200);
    }

    /**
     * About page test status
     *
     * @return void
     */
    public function test_home_about_successful_page()
    {
        $response = $this->get(route('home.about'));

        $response->assertStatus(200);
    }
}
