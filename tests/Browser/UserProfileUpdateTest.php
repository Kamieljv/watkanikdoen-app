<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserProfileUpdateTest extends DuskTestCase
{
    public function testProfilePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('email', '=', 'scoobydoo@gmail.com')->first())
                ->visit('/settings/profile')
                ->assertSee('Scooby Doo\'s Profile Settings')
                ->value('#uploadBase64', 'data:image/jpeg;base64,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')
                ->type('about', 'Hello, my name is Scooby. I like to solve mysteries and eat scooby snacks. My best bud is Shaggy, him and I are always hangin out. I also built the Mystery Inc\'s website.')
                ->click('@update-profile-button');
        });
    }
}
