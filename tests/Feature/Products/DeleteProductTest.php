<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_delete_product_if_record_is_exist()
    {
        $this->loginWithSuperAdmin();
        $cateCreated = Product::factory()->create()->toArray();
        $userCountBefore = Product::count();
        $response = $this->delete($this->getDestroyProductRoute($cateCreated['id']));
        $userCountAfter = Product::count();
        $this->assertEquals($userCountBefore - 1, $userCountAfter);
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /** @test */
    public function authenticated_authorize_user_can_not_delete_product_if_record_is_not_exist()
    {
        $this->loginWithSuperAdmin();
        $cateId = -1;
        $response = $this->delete($this->getDestroyProductRoute($cateId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('message')->has('status')
            ->etc()
        );
    }

    /** @test */
    public function unauthenticated_user_can_not_delete_product()
    {
        $cateCreated = Product::factory()->create()->toArray();
        $response = $this->delete($this->getDestroyProductRoute($cateCreated['id']));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_delete_product()
    {
        $this->loginWithUser();
        $cateCreated = Product::factory()->create()->toArray();
        $response = $this->delete($this->getDestroyProductRoute($cateCreated['id']));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getDestroyProductRoute($id)
    {
        return route('products.destroy', $id);
    }
}
