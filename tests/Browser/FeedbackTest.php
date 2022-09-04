<?php

namespace Tests\Browser;

use App\Models\Feedback;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FeedbackTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateForm(): void
    {
        $feedback = Feedback::factory()->create();

        $this->browse(static function (Browser $browser) use($feedback) {
            $browser->visit('/feedback')
                ->type('name', $feedback->name)
                ->type('description', $feedback->description)
                ->press('Сохранить')
                ->assertPathIs('/feedback');
        });
    }

    public function testCreateFormFields(): void
    {
        $this->browse(static function (Browser $browser) {
            $browser->visit('/feedback')
                ->assertSee('Имя пользователя')
                ->assertSee('Отзыв по работе проекта');
        });
    }
}
