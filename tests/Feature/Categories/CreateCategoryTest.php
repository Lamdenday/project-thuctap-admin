<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_create_new_category_if_data_is_valid()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Category::factory()->make()->toArray();
        $categoryCountBefore = Category::count();
        $response = $this->post($this->getCreateCategoryRoute(), $dataCreate);
        $categoryCountAfter = Category::count();
        $this->assertEquals($categoryCountBefore + 1, $categoryCountAfter);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('categories', $dataCreate);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('data', fn(AssertableJson $json) =>
                $json->where('name', $dataCreate['name'])
                    ->etc())
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_category_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Category::factory()->make(['name' => null])->toArray();
        $response = $this->post($this->getCreateCategoryRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('name', fn(AssertableJson $json) =>
                    $json->where('0','The name field is required.')
                )
            )
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_category_if_parent_id_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Category::factory()->make(['parent_id' => null])->toArray();
        $response = $this->post($this->getCreateCategoryRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('parent_id', fn(AssertableJson $json) =>
                    $json->where('0','The parent id field is required.')
                )
            )
        );
    }

    /** @test */
    public function unauthenticated_authorize_user_can_not_create_new_category()
    {
        $dataCreate = Category::factory()->make()->toArray();
        $response = $this->post($this->getCreateCategoryRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_create_new_category()
    {
        $this->loginWithUser();
        $dataCreate = Category::factory()->make()->toArray();
        $response = $this->post($this->getCreateCategoryRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getCreateCategoryRoute()
    {
        return route('categories.store');
    }
}
