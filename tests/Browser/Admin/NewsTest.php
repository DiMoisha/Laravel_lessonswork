<?php

namespace Tests\Browser\Admin;

use App\Models\News;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testCreateForm(): void
    {
        $news = News::factory()->create();

        $this->browse(static function (Browser $browser) use ($news) {
            $browser->visit('http://laravel.local/admin/news/create')
                ->select('categoryid')
                ->select('feedsourceid')
                ->type('title', $news->title)
                ->type('description', $news->description)
                ->type('author', $news->author)
                //->type('image', $news->image)
                ->select('status')
                ->press('Сохранить')
                ->assertPathIs('/admin/news');
        });
    }

    /***
     * Edit form test.
     *
     * @return void
     * @throws \Throwable
     */
    public function testEditForm(): void
    {
        $news = News::factory()->create();

        $this->browse(static function (Browser $browser) use ($news) {
            $browser->visit('http://laravel.local/admin/news/53/edit')
                ->select('categoryid')
                ->select('feedsourceid')
                ->type('title', $news->title)
                ->type('description', $news->description)
                ->type('author', $news->author)
                //->type('image', $news->image)
                ->select('status')
                ->press('Сохранить')
                ->assertPathIs('/admin/news');
        });
    }

    /***
     * Test fields.
     *
     * @return void
     * @throws \Throwable
     */
    public function testCreateFormFields(): void
    {
        $this->browse(static function (Browser $browser) {
            $browser->visit('http://laravel.local/admin/news/create')
                ->assertSee('Выбрать категорию')
                ->assertSee('Выбрать источник новости')
                ->assertSee('Заголовок')
                ->assertSee('Содержание новости')
                ->assertSee('Автор')
                ->assertSee('Изображение')
                ->assertSee('Статус');
        });
    }
}
