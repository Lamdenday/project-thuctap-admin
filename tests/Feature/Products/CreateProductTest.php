<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_create_new_product_if_data_is_valid()
    {
        $this->loginWithSuperAdmin();
        $dataCreate = Product::factory()->make()->toArray();
        $categoryCountBefore = Product::count();
        $response = $this->post(route('products.store'), $dataCreate);
        $categoryCountAfter = Product::count();
        $this->assertEquals($categoryCountBefore + 1, $categoryCountAfter);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(fn(AssertableJson $json) =>
        $json->has('data', fn(AssertableJson $json) =>
        $json->where('name', $dataCreate['name'])
            ->etc())
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_product_if_name_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreate = Product::factory()->make(['name' => null, 'image_url' => $file])->toArray();
        $response = $this->post($this->getStoreProductRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('name'))
            ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_cate_if_category_field_is_null()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->image('image.jpg');
        $dataCreate = Product::factory()->make(['category_id' => null, 'image_url' => $file])->toArray();
        $response = $this->post($this->getStoreProductRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('category_id'))
                ->etc()
        );
    }

    /** @test */
    public function authenticated_authorize_user_can_not_create_new_cate_if_image_field_is_not_image()
    {
        $this->loginWithSuperAdmin();
        $file = UploadedFile::fake()->create(
            'document.pdf',123, 'application/pdf'
        );
        $dataCreate = Product::factory()->make(['image_url' => $file])->toArray();
        $response = $this->post($this->getStoreProductRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('errors', fn(AssertableJson $json) =>
                $json->has('image_url')
                    ->has('image_url'))
            ->etc()
        );
    }

    /** @test */
    public function unauthenticated_user_can_not_create_new_product()
    {
        $dataCreate = Product::factory()->make()->toArray();
        $response = $this->post($this->getStoreProductRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_create_new_cate()
    {
        $this->loginWithUser();
        $dataCreate = Product::factory()->make()->toArray();
        $response = $this->post($this->getStoreProductRoute(), $dataCreate);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getStoreProductRoute()
    {
        return route('products.store');
    }
}
