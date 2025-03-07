<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Family;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FamilyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_family()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('family.create'), ['name' => 'Test Family']);

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('success', 'Family created successfully');

        $this->assertDatabaseHas('families', ['name' => 'Test Family']);
        $this->assertEquals('head', $user->fresh()->role);
    }

    public function test_user_can_join_family_with_valid_code()
    {
        $user = User::factory()->create();
        $family = Family::factory()->create(['code' => 'ABC123']);

        $this->actingAs($user);

        $response = $this->post(route('family.join'), ['code' => 'ABC123']);

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('success', 'Joined family!');

        $this->assertEquals($family->id, $user->fresh()->family_id);
        $this->assertEquals('member', $user->fresh()->role);
    }

    public function test_user_cannot_join_family_with_invalid_code()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('family.join'), ['code' => 'WRONG123']);

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('error', 'Invalid family code');

        $this->assertNull($user->fresh()->family_id);
    }

    public function test_family_head_can_delete_family()
    {
        $user = User::factory()->create();
        $family = Family::factory()->create();
        $user->family_id = $family->id;
        $user->role = 'head';
        $user->save();

        $this->actingAs($user);

        $response = $this->delete(route('family.destroy'));

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('success', 'Family deleted successfully');

        $this->assertDatabaseMissing('families', ['id' => $family->id]);
        $this->assertNull($user->fresh()->family_id);
        $this->assertEquals('member', $user->fresh()->role);
    }

    public function test_non_head_cannot_delete_family()
    {
        $user = User::factory()->create();
        $family = Family::factory()->create();
        $user->family_id = $family->id;
        $user->role = 'member';
        $user->save();

        $this->actingAs($user);

        $response = $this->delete(route('family.destroy'));

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('error', 'You are not authorized to delete this family');

        $this->assertDatabaseHas('families', ['id' => $family->id]);
    }

    public function test_member_can_leave_family()
    {
        $user = User::factory()->create();
        $family = Family::factory()->create();
        $user->family_id = $family->id;
        $user->role = 'member';
        $user->save();

        $this->actingAs($user);

        $response = $this->post(route('family.leave'));

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('success', 'Left family!');

        $this->assertNull($user->fresh()->family_id);
    }

    public function test_family_head_cannot_leave_family()
    {
        $user = User::factory()->create();
        $family = Family::factory()->create();
        $user->family_id = $family->id;
        $user->role = 'head';
        $user->save();

        $this->actingAs($user);

        $response = $this->post(route('family.leave'));

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('error', 'You are not authorized to leave this family');

        $this->assertEquals($family->id, $user->fresh()->family_id);
    }

    public function test_family_head_can_remove_member()
    {
        $head = User::factory()->create();
        $member = User::factory()->create();

        $family = Family::factory()->create();
        $head->family_id = $family->id;
        $head->role = 'head';
        $head->save();

        $member->family_id = $family->id;
        $member->role = 'member';
        $member->save();

        $this->actingAs($head);

        $response = $this->delete(route('family.remove', $member));

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('success', 'Removed member from family');

        $this->assertNull($member->fresh()->family_id);
    }

    public function test_member_cannot_remove_another_member()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $family = Family::factory()->create();

        $user1->family_id = $family->id;
        $user1->role = 'member';
        $user1->save();

        $user2->family_id = $family->id;
        $user2->role = 'member';
        $user2->save();

        $this->actingAs($user1);

        $response = $this->delete(route('family.remove', $user2));

        $response->assertRedirect(route('family.index'))
            ->assertSessionHas('error', 'You are not authorized to remove this member');

        $this->assertEquals($family->id, $user2->fresh()->family_id);
    }
}