<?php

namespace Tests\Feature\Roles;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use App\Models\Role;
use Tests\TestCase;

class CreateRoleTest extends TestCase
{
    public function dataCreate()
    {
        $role = [
            'name' => ucfirst($this->faker->unique()->randomLetter),
            'display_name' => ucfirst($this->faker->unique()->name),
            'permission' => [
                Permission::inRandomOrder()->first()->id,
            ]
        ];
        return $role;
    }
    /** @test */
    public function authenticated_authorize_user_can_create_new_role_if_data_is_valid()
    {
        $this->loginWithSuperAdmin();
        $role = $this->dataCreate();
        $userCountBefore = Role::count();
        $response = $this->post($this->getCreateRoleRoute(), $role);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', [
            'name' => $role['name'],
            'display_name' => $role['display_name']
        ]);
        $userCountAfter = Role::count();
        $this->assertEquals($userCountBefore + 1, $userCountAfter);
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_role_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $role = $this->dataCreate();
        $role['name'] = null;
        $response = $this->from($this->getCreateRoleViewRoute())->post($this->getCreateRoleRoute(), $role);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect($this->getCreateRoleViewRoute());
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_role_if_permission_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $role = $this->dataCreate();
        $role['permission'] = null;
        $response = $this->from($this->getCreateRoleViewRoute())->post($this->getCreateRoleRoute(), $role);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect($this->getCreateRoleViewRoute());
        $response->assertSessionHasErrors('permission');
    }

    /** @test */
    public function unauthenticated_user_can_not_create_new_role()
    {
        $role = $this->dataCreate();
        $response = $this->post($this->getCreateRoleRoute(), $role);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_authorize_user_can_see_role_form_create()
    {
        $this->loginWithSuperAdmin();
        $response = $this->get($this->getCreateRoleViewRoute());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('roles.create');
    }

    /** @test */
    public function unauthenticated_authorize_user_can_not_see_role_form_create()
    {
        $response = $this->get($this->getCreateRoleViewRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('login');
    }

    public function getCreateRoleRoute()
    {
        return route('roles.store');
    }

    public function getCreateRoleViewRoute()
    {
        return route('roles.create');
    }
}
