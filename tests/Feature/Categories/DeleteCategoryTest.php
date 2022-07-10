<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_delete_category_if_record_is_exist()
    {
        $this->loginWithSuperAdmin();
        $cateCreated = Category::factory()->create()->toArray();
        $categoryCountBefore = Category::count();
        $response = $this->delete($this->getDeleteCategoryRoute($cateCreated['id']));
        $categoryCountAfter = Category::count();
        $this->assertEquals($categoryCountBefore - 1, $categoryCountAfter);
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /** @test */
    public function authenticated_authorize_user_can_not_delete_category_if_record_is_not_exist()
    {
        $this->loginWithSuperAdmin();
        $cateId = -1;
        $response = $this->delete($this->getDeleteCategoryRoute($cateId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('message')->has('status')
            ->etc()
        );
    }

    /** @test */
    public function unauthenticated_user_can_not_delete_category()
    {
        $cateCreated = Category::factory()->create()->toArray();
        $response = $this->delete($this->getDeleteCategoryRoute($cateCreated['id']));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_delete_category()
    {
        $this->loginWithUser();
        $cateCreated = Category::factory()->create()->toArray();
        $response = $this->delete($this->getDeleteCategoryRoute($cateCreated['id']));
        $response->assertStatus(403);
    }

    public function getDeleteCategoryRoute($id)
    {
        return route('categories.destroy', $id);
    }
}
