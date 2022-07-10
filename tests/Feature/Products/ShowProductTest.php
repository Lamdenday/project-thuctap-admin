<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_see_product_if_product_is_valid()
    {
        $this->actingAs(User::oldest('id')->first());
        $dataCreated = Product::factory()->create(['image_url' => $this->faker->imageUrl]);
        $response = $this->get(route('products.show', $dataCreated['id']));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('products.edit');
        $response->assertSeeText(['description' => $dataCreated->description]);
        $response->assertSeeText(['content' => $dataCreated->content]);
    }

    /** @test */
    public function authenticated_authorize_user_can_not_see_product_if_product_is_not_exist()
    {
        $this->actingAs(User::oldest('id')->first());
        $productId = -1;
        $response = $this->get(route('products.show', $productId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function unauthenticated_user_can_not_see_product()
    {
        $dataCreated = Product::factory()->create(['image_url' => $this->faker->imageUrl])->toArray();
        $response = $this->get(route('products.show', $dataCreated['id']));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }
}
