<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EditProductTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_edit_product_if_data_is_valid()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create()->toArray();
        $dataEdit = Product::factory()->make(['image_url' => $file])->toArray();
        array_splice($dataEdit, 6);
        $response = $this->post($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('products', $dataEdit);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataEdit['name'])
            ->where('description', $dataEdit['description'])
            ->etc()
        )->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_edit_product_if_image_is_null()
    {
        $this->loginWithSuperAdmin();
        $dataCreated = Product::factory()->create()->toArray();
        $dataEdit = Product::factory()->make(['image_url' => null])->toArray();
        array_splice($dataEdit, 6);
        $response = $this->post($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('products', $dataEdit);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataEdit['name'])
            ->where('description', $dataEdit['description'])
            ->etc()
        )->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_product_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create(['image_url' => $file])->toArray();
        $dataEdit = Product::factory()->make(['name' => null, 'image_url' => $file])->toArray();
        $response = $this->post($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('name'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_product_if_category_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create(['image_url' => $file])->toArray();
        $dataEdit = Product::factory()->make(['category_id' => null, 'image_url' => $file])->toArray();
        $response = $this->post($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('category_id'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_edit_cate_if_image_field_is_not_image()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->create(
            'document.pdf', 123, 'application/pdf'
        );
        $dataCreated = Product::factory()->create()->toArray();
        $dataEdit = Product::factory()->make(['image_url' => $file])->toArray();
        $response = $this->post($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('errors', fn(AssertableJson $json) =>
        $json->has('image_url')
            ->has('image_url'))
            ->etc()
        );
    }

    /** @test */
    public function unauthenticated_user_can_not_edit_product()
    {
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreate = Product::factory()->create()->toArray();
        $dataEdit = Product::factory()->make(['image_url' => $file])->toArray();
        $response = $this->post($this->getUpdateProductRoute($dataCreate['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_edit_product()
    {
        $this->loginWithUser();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreated = Product::factory()->create()->toArray();
        $dataEdit = Product::factory()->make(['image_url' => $file])->toArray();
        $response = $this->post($this->getUpdateProductRoute($dataCreated['id']), $dataEdit);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function authenticated_authorize_user_can_see_form_edit_product()
    {
        $this->loginWithSuperAdmin();
        $productCreated = Product::factory()->create()->toArray();
        $response = $this->get($this->getEditProductViewRoute($productCreated['id']));
        $response->assertViewIs('products.edit');
        $response->assertSee($productCreated['name']);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_form_edit_product()
    {
        $productCreated = Product::factory()->create()->toArray();
        $response = $this->get($this->getEditProductViewRoute($productCreated['id']));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    public function getUpdateProductRoute($id)
    {
        return route('products.update', $id);
    }

    public function getEditProductViewRoute($id)
    {
        return route('products.show', $id);
    }
}
