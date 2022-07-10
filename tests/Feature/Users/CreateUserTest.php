<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_create_new_user_if_data_is_valid()
    {
        $this->loginWithSuperAdmin();
        $countUserBefore = User::count();
        $passwordFaker = $this->faker->password(8);
        $dataCreate = User::factory()->make([
            'password_confirmation' => $passwordFaker,
            'roles' => [Role::inRandomOrder()->first()->id],
        ])->toArray();
        $dataCreate['password'] = $passwordFaker;
        $response = $this->post(route('users.store', $dataCreate));
        $response->assertStatus(Response::HTTP_CREATED);
        $countUserAfter = User::count();
        $this->assertEquals($countUserAfter - 1, $countUserBefore);
        array_splice($dataCreate, 3);
        $this->assertDatabaseHas('users', $dataCreate);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataCreate['name'])
            ->etc())
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_user_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $passwordFaker = $this->faker->password(8);
        $dataCreate = User::factory()->make([
            'name' => null,
            'password_confirmation' => $passwordFaker
        ])->toArray();
        $dataCreate['password'] = $passwordFaker;
        $response = $this->post($this->getCreateUserRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('name'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_user_if_email_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $passwordFaker = $this->faker->password;
        $dataCreate = User::factory()->make([
            'email' => null,
            'password_confirmation' => $passwordFaker
        ])->toArray();
        $dataCreate['password'] = $passwordFaker;
        $response = $this->post($this->getCreateUserRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('email')->etc())
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_user_if_password_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = User::factory()->make()->toArray();
        $dataCreate['password'] = null;
        $response = $this->post($this->getCreateUserRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('password'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_user_if_phone_field_is_not_valid()
    {
        $this->loginWithSuperAdmin();
        $passwordFaker = $this->faker->password(8);
        $dataCreate = User::factory()->make([
            'phone_number' => $this->faker->phoneNumber,
            'password_confirmation' => $passwordFaker
        ])->toArray();
        $dataCreate['password'] = $passwordFaker;
        $response = $this->post($this->getCreateUserRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('phone_number'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_user_if_password_and_password_confirmation_are_different()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = User::factory()->make()->toArray();
        $dataCreate['password'] = $this->faker->password;
        $dataCreate['password_confirm'] = $this->faker->password;
        $response = $this->post($this->getCreateUserRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('password'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_create_new_user()
    {
        $this->loginWithUser();
        $passwordFaker = $this->faker->password;
        $dataCreate = User::factory()->make([
            'password_confirmation' => $passwordFaker,
            'roles' => [Role::inRandomOrder()->first()->id],
        ])->toArray();
        $dataCreate['password'] = $passwordFaker;
        $response = $this->post($this->getCreateUserRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function getCreateUserRoute()
    {
        return route('users.store');
    }
}
