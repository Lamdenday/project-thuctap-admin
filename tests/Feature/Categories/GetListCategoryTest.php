<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListCategoryTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_see_all_category()
    {
        $this->loginWithSuperAdmin();
        $cateCreated = Category::factory()->create();
        $response = $this->get($this->getListCategoryRoute());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('categories.index');
        $response->assertSeeText($cateCreated->name);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_all_category()
    {
        $response = $this->get($this->getListCategoryRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_see_all_category()
    {
        $this->loginWithUser();
        $response = $this->get($this->getListCategoryRoute());
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getListCategoryRoute()
    {
        return route('categories.index');
    }
}
