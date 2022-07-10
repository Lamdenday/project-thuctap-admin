<?php

namespace Tests\Feature\Roles;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditRoleTest extends TestCase
{
    public function dataCreated()
    {
        $role = Role::factory()->create();
        return $role;
    }

    public function dataEdit()
    {
        $dataEdit = [
            'name' => ucfirst($this->faker->name()),
            'display_name' => ucfirst($this->faker->unique()->name),
            'permission' => [Permission::inRandomOrder()->first()->id]
        ];
        return $dataEdit;
    }

    /** @test */
    public function authenticated_authorize_user_can_edit_role_if_data_is_valid()
    {
        $this->loginWithSuperAdmin();
        $role = $this->dataCreated();
        $role->attachPermission(Permission::all()->random()->id);
        $dataEdit = $this->dataEdit();
        $response = $this->put($this->getEditRoleRoute($role['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('roles.index'));
        $this->assertDatabaseHas('roles', ['name' => $dataEdit['name']]);
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_role_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $role = $this->dataCreated();
        $role->attachPermission([Permission::inRandomOrder()->first()->id]);
        $dataEdit = $this->dataEdit();
        $dataEdit['name'] = null;
        $response = $this->put($this->getEditRoleRoute($role['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_role_if_permission_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $role = $this->dataCreated();
        $role->attachPermission([Permission::inRandomOrder()->first()->id]);
        $dataEdit = $this->dataEdit();
        $dataEdit['permission'] = null;
        $response = $this->put($this->getEditRoleRoute($role['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('permission');
    }

    /** @test */
    public function unauthenticated_user_can_not_edit_role()
    {
        $role = $this->dataCreated();
        $role->attachPermission([Permission::inRandomOrder()->first()->id]);
        $response = $this->put($this->getEditRoleRoute($role['id']), $this->dataEdit());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_authorize_user_can_see_role_form_edit()
    {
        $this->loginWithSuperAdmin();
        $role = $this->dataCreated();
        $role->attachPermission([Permission::inRandomOrder()->first()->id]);
        $response = $this->get($this->getEditRoleRouteView($role['id']));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('roles.edit');
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_see_role_form_edit()
    {
        $this->loginWithUser();
        $role = $this->dataCreated();
        $role->attachPermission([Permission::inRandomOrder()->first()->id]);
        $response = $this->get($this->getEditRoleRoute($role['id']));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getEditRoleRoute($id)
    {
        return route('roles.update', $id);
    }

    public function getEditRoleRouteView($id)
    {
        return route('roles.edit', $id);
    }
}
