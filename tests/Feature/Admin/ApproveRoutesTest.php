<?php

use App\Models\Organizer;
use App\Models\Report;
use App\Models\User;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);

    $this->organizer = Organizer::factory()->create(['status' => 'PENDING']);
    $this->report = Report::factory()->create([
        'user_id' => User::factory()->create()->id,
        'organizer_ids' => (string) Organizer::factory()->create(['status' => 'PUBLISHED'])->id,
        'status' => 'PENDING',
        'start_date' => now()->addDay()->format('Y-m-d'),
        'end_date' => now()->addDay()->format('Y-m-d'),
    ]);
});

describe('Approve routes', function () {

    it('redirects guests to the login page', function () {
        $this->get(route('report.approve', $this->report->id))->assertRedirect(route('login'));
        $this->get(route('organizer.approve', $this->organizer->id))->assertRedirect(route('login'));

        expect($this->report->fresh()->status)->toBe('PENDING')
            ->and($this->organizer->fresh()->status)->toBe('PENDING');
    });

    it('forbids logged-in users that are not admin', function () {
        $this->actingAs(User::factory()->create());

        $this->get(route('report.approve', $this->report->id))->assertForbidden();
        $this->get(route('organizer.approve', $this->organizer->id))->assertForbidden();

        expect($this->report->fresh()->status)->toBe('PENDING')
            ->and($this->organizer->fresh()->status)->toBe('PENDING');
    });

    it('lets admins approve reports and organizers', function () {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $this->get(route('report.approve', $this->report->id))->assertRedirect();
        $this->get(route('organizer.approve', $this->organizer->id))->assertRedirect();

        expect($this->report->fresh()->status)->toBe('APPROVED')
            ->and($this->organizer->fresh()->status)->not->toBe('PENDING');
    });

});
