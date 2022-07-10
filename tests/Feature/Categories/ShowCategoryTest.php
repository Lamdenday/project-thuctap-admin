<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_see_category_if_category_is_valid()
    {
        $this->loginWithSuperAdmin();
        $cateCreated = Category::factory()->create()->toArray();
        $response = $this->get($this->getShowProductRoute($cateCreated['id']));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSeeText($cateCreated['name']);
        $response->assertViewIs('categories.edit');
    }

    /** @test */
    public function authenticated_authorize_user_can_not_see_category_if_category_is_not_exist()
    {
        $this->loginWithSuperAdmin();
        $cateId = -1;
        $response = $this->get($this->getShowProductRoute($cateId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('message')->has('status')
            ->etc()
        );
    }

    /** @test */
    public function unauthenticated_user_can_not_see_category()
    {
        $cateCreated = Category::factory()->create()->toArray();
        $response = $this->get($this->getShowProductRoute($cateCreated['id']));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getShowProductRoute($id)
    {
        return route('categories.show', $id);
    }
}
