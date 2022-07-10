<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListUserTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_see_all_user()
    {
        $this->loginWithSuperAdmin();
        $response = $this->get($this->getListUserRoute());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('users.index');
    }

    /** @test */
    public function unauthenticated_user_can_not_see_all_user()
    {
        $response = $this->get($this->getListUserRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_see_all_user()
    {
        $this->loginWithUser();
        $response = $this->get($this->getListUserRoute());
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getListUserRoute()
    {
        return route('users.index');
    }
}
