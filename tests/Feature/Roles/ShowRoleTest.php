<?php

namespace Tests\Feature\Roles;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ShowRoleTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_see_show_role_if_role_is_exist()
    {
        $this->loginWithSuperAdmin();
        $role = Role::first();
        $response = $this->get($this->getRouteShowRole($role->id));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('roles.show');
        $response->assertSeeText($role->name);
    }

    /** @test */
    public function authenticated_user_can_not_see_show_role_if_role_is_not_exist()
    {
        $this->loginWithSuperAdmin();
        $roleId = -1;
        $response = $this->get($this->getRouteShowRole($roleId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_show_role()
    {
        $role = Role::first();
        $response = $this->get($this->getRouteShowRole($role->id));
        $response->assertRedirect(route('login'));
    }

    public function getRouteShowRole($id)
    {
        return route('roles.show', $id);
    }
}
