<?php

namespace Tests\Feature\Roles;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListRoleTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_see_all_role()
    {
        $this->loginWithSuperAdmin();
        $response = $this->get($this->getListRoleRoute());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('roles.index');
    }

    /** @test */
    public function authenticated_no_authorize_user_can_not_see_all_role()
    {
        $this->loginWithUser();
        $response = $this->get($this->getListRoleRoute());
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /** @test */
    public function unauthenticated_user_can_not_see_all_role()
    {
        $response = $this->get($this->getListRoleRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getListRoleRoute()
    {
        return route('roles.index');
    }
}
