<?php

namespace Tests\Browser\Admin;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{
    /**
     * A Dusk test create.
     *
     * @return void
     * @throws \Throwable
     */
    public function testCreateForm(): void
    {
        $category = Category::factory()->create();

        $this->browse(static function (Browser $browser) use ($category) {
            $browser->visit('http://laravel.local/admin/categories/create')
                ->type('title', $category->title)
                ->type('description', $category->description)
                ->type('tabindex', $category->tabindex)
                ->press('Сохранить')
                ->assertPathIs('/admin/categories');
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
        $category = Category::factory()->create();

        $this->browse(static function (Browser $browser) use ($category) {
            $browser->visit('http://laravel.local/admin/categories/6/edit')
                ->type('title', $category->title)
                ->type('description', $category->description)
                ->type('tabindex', $category->tabindex)
                ->press('Сохранить')
                ->assertPathIs('/admin/categories');
        });
    }
}
