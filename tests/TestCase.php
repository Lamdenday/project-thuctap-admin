<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    protected function loginWithSuperAdmin()
    {
        $user = User::factory()->create();

        $role = Role::where('name', 'super_admin')->pluck('id');

        $user->userRoles()->attach($role);

        return $this->actingAs($user);
    }

    protected function loginWithUser()
    {
        $user = User::factory()->create();

        return $this->actingAs($user);
    }
}
