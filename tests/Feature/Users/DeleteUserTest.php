<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_delete_user()
    {
        $this->loginWithSuperAdmin();
        $userCreated = User::factory()->create()->toArray();
        $response = $this->delete($this->getDeleteUserRoute($userCreated['id']));
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('users', ['id' => $userCreated['id']]);
    }

    /** @test */
    public function authenticated_authorize_user_can_not_delete_user_if_record_is_not_exist()
    {
        $this->loginWithSuperAdmin();
        $cateId = -1;
        $response = $this->delete($this->getDeleteUserRoute($cateId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('message')->has('status')
            ->etc()
        );
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_delete_user()
    {
        $this->loginWithUser();
        $userCreated = User::factory()->create();
        $userCreated->attachRole(Role::inRandomOrder()->first()->id);
        $response = $this->delete($this->getDeleteUserRoute($userCreated));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function unauthenticated_user_can_not_delete_user()
    {
        $userCreated = User::factory()->create();
        $response = $this->delete($this->getDeleteUserRoute($userCreated->id));
        $response->assertRedirect(route('login'));
    }

    public function getDeleteUserRoute($id)
    {
        return route('users.destroy', $id);
    }
}
