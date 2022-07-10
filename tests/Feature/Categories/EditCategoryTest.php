<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EditCategoryTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_edit_category_if_data_is_valid()
    {
        $this->loginWithSuperAdmin();
        $categoryCreated = Category::factory()->create()->toArray();
        $dataEdit = Category::factory()->make()->toArray();
        $response = $this->put($this->getEditCategoryRoute($categoryCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('categories', $dataEdit);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('data', fn(AssertableJson $json) =>
                $json->where('name', $dataEdit['name'])
                     ->where('description', $dataEdit['description'])
                ->etc()
            )->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_new_category_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $categoryCreated = Category::factory()->create()->toArray();
        $dataEdit = Category::factory()->make(['name' => null])->toArray();
        $response = $this->put($this->getEditCategoryRoute($categoryCreated['id']), $dataEdit);
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
    public function authenticated_authorize_user_can_not_edit_category_if_category_is_not_exist()
    {
        $this->loginWithSuperAdmin();
        $categoryId = -1;
        $dataEdit = Category::factory()->make()->toArray();
        $response = $this->put($this->getEditCategoryRoute($categoryId), $dataEdit);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('message')
            ->has('status')
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_see_form_edit_category()
    {
        $this->loginWithSuperAdmin();
        $categoryCreated = Category::factory()->create()->toArray();
        $response = $this->get($this->getEditCategoryViewRoute($categoryCreated['id']));
        $response->assertViewIs('categories.edit');
        $response->assertSeeText($categoryCreated['name']);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_form_edit_category()
    {
        $categoryCreated = Category::factory()->create()->toArray();
        $response = $this->get($this->getEditCategoryViewRoute($categoryCreated['id']));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthenticated_user_can_not_edit_category()
    {
        $categoryCreated = Category::factory()->create()->toArray();
        $dataEdit = Category::factory()->make()->toArray();
        $response = $this->put($this->getEditCategoryRoute($categoryCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_edit_category()
    {
        $this->loginWithUser();
        $categoryCreated = Category::factory()->create()->toArray();
        $dataEdit = Category::factory()->make()->toArray();
        $response = $this->put($this->getEditCategoryRoute($categoryCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getEditCategoryRoute($id)
    {
        return route('categories.update', $id);
    }

    public function getEditCategoryViewRoute($id)
    {
        return route('categories.show', $id);
    }
}
