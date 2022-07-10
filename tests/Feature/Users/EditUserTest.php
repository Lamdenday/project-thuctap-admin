<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_edit_user_if_data_is_valid()
    {
        $this->loginWithSuperAdmin();
        $userCreated = User::factory()->create();
        $userCreated->attachRole(Role::inRandomOrder()->first()->id);
        $dataEdit = User::factory()->make([
            'roles' => [Role::inRandomOrder()->first()->id]
        ])->toArray();
        $response = $this->put(route('users.update', $userCreated->id), $dataEdit);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('users', [
            'name' => $dataEdit['name'],
            'email' => $dataEdit['email']
        ]);
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_user_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $userCreated = User::factory()->create();
        $userCreated->attachRole(Role::inRandomOrder()->first()->id);
        $dataEdit = User::factory()->make([
            'name' => null,
        ])->toArray();
        $response = $this->put(route('users.update', $userCreated->id), $dataEdit);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('name'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_user_if_email_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $userCreated = User::factory()->create();
        $userCreated->attachRole(Role::inRandomOrder()->first()->id);
        $dataEdit = User::factory()->make([
            'email' => null,
        ])->toArray();
        $response = $this->put(route('users.update', $userCreated->id), $dataEdit);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('email'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_user_if_phone_number_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $userCreated = User::factory()->create();
        $userCreated->attachRole(Role::inRandomOrder()->first()->id);
        $dataEdit = User::factory()->make([
            'phone_number' => null,
        ])->toArray();
        $response = $this->put(route('users.update', $userCreated->id), $dataEdit);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('phone_number'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_edit_new_user()
    {
        $this->loginWithUser();
        $userCreated = User::factory()->create();
        $userCreated->attachRole(Role::inRandomOrder()->first()->id);
        $dataEdit = User::factory()->make()->toArray();
        $response = $this->put(route('users.update', $userCreated->id), $dataEdit);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function authenticated_authorize_user_can_see_form_edit_user()
    {
        $this->loginWithSuperAdmin();
        $userCreated = User::factory()->create()->toArray();
        $response = $this->get($this->getEditUserViewRoute($userCreated['id']));
        $response->assertViewIs('users.edit');
        $response->assertSee($userCreated['name']);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_form_edit_user()
    {
        $userCreated = User::factory()->create()->toArray();
        $response = $this->get($this->getEditUserViewRoute($userCreated['id']));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getEditUserRoute()
    {
        return route('users.update');
    }

    public function getEditUserViewRoute($id)
    {
        return route('users.edit', $id);
    }
}
