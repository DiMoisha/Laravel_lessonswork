<?php

namespace Tests\Browser\Admin;

use App\Models\Feedback;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FeedbackTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testCreateForm(): void
    {
        $feedback = Feedback::factory()->create();

        $this->browse(static function (Browser $browser) use($feedback) {
            $browser->visit('http://laravel.local/feedback/create')
                ->type('sendername', $feedback->sendername)
                ->type('senderemail', $feedback->senderemail)
                ->type('message', $feedback->message)
                ->press('Отправить')
                ->assertPathIs('/');
        });
    }
}
