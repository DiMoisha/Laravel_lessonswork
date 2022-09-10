<?php

namespace Tests\Browser\Admin;

use App\Models\Order;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OrderTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testCreateForm(): void
    {
        $order = Order::factory()->create();

        $this->browse(static function (Browser $browser) use($order) {
            $browser->visit('http://laravel.local/admin/orders/create')
                ->type('sourceemail', $order->sourceemail)
                ->type('customername', $order->customername)
                ->type('customertel', $order->customertel)
                ->type('customeremail', $order->customeremail)
                ->type('description', $order->description)
                ->press('Отправить заказ')
                ->assertPathIs('/admin/orders');
        });
    }
}
