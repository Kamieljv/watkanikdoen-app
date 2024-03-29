<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    //use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        //$this->artisan('db:seed');
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testText()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') //->dump()
                    ->waitForText('Wave is the perfect starter kit')
                    ->assertSeeIn('h2', 'Wave is the perfect starter kit');
        });
    }
}
