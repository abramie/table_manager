<?php

namespace Tests\Feature;

use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = Profile::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/compte');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = Profile::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/compte', [
                'name' => 'Test Profile',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/compte');

        $user->refresh();

        $this->assertSame('Test Profile', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = Profile::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/compte', [
                'name' => 'Test Profile',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/compte');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = Profile::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/compte', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = Profile::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/compte')
            ->delete('/compte', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/compte');

        $this->assertNotNull($user->fresh());
    }
}
