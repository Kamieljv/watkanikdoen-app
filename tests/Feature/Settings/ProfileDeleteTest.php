<?php

namespace Tests\Feature\Settings;

use App\Models\Actie;
use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProfileDeleteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // The application expects an admin role to exist.
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        Storage::fake('public');
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('settings.profile.delete', $user->id))
            ->assertRedirect();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_reports_are_unassigned_when_user_is_deleted(): void
    {
        $user = User::factory()->create();

        $report = Report::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->post(route('settings.profile.delete', $user->id));

        $this->assertDatabaseHas('reports', [
            'id' => $report->id,
            'user_id' => null,
        ]);
    }

    public function test_other_report_organizers_are_not_removed(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $report = Report::factory()->create([
            'user_id' => $user->id,
            'organizer_ids' => implode(',', [
                $user->id,
                $otherUser->id,
            ]),
        ]);

        $this->actingAs($user)
            ->post(route('settings.profile.delete', $user->id));

        $report->refresh();

        $this->assertContains(
            (string) $otherUser->id,
            $report->organizer_ids
        );
    }

    public function test_users_acties_are_transferred_to_an_admin(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $user = User::factory()->create();

        $actie = Actie::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->post(route('settings.profile.delete', $user->id));

        $this->assertDatabaseHas('acties', [
            'id' => $actie->id,
            'user_id' => $admin->id,
        ]);
    }

    public function test_acties_belonging_to_other_users_are_not_changed(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $otherActie = Actie::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $this->actingAs($user)
            ->post(route('settings.profile.delete', $user->id));

        $this->assertDatabaseHas('acties', [
            'id' => $otherActie->id,
            'user_id' => $otherUser->id,
        ]);
    }

    public function test_user_cannot_delete_another_users_account(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($user)
            ->post(route('settings.profile.delete', $otherUser->id))
            ->assertForbidden();

        $this->assertDatabaseHas('users', [
            'id' => $otherUser->id,
        ]);
    }
}
