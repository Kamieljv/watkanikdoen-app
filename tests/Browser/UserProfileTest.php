<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserProfileTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testProfilePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('email', '=', 'scoobydoo@gmail.com')->first())
                ->visit('/@scoobydoo')
                ->assertSee('Scooby Doo');
        });
    }
}
