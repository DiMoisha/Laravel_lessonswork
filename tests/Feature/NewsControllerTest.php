<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    /**
     * News index page by category test status
     *
     * @return void
     */
    public function test_news_index_successful_page()
    {
        $response = $this->get(route('news.index', 1));

        $response->assertStatus(200);
    }

    /**
     * News item show page test status
     *
     * @return void
     */
    public function test_news_show_successful_page()
    {
        $response = $this->get(route('news.show', 5));

        $response->assertStatus(200);
    }
}
