<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListProductTest extends TestCase
{
    /** @test */
    public function authenticated_authorize_user_can_see_all_product()
    {
        $this->actingAs(User::oldest('id')->first());
        $response = $this->get($this->getListProductRoute());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('products.index');
    }

    /** @test */
    public function unauthenticated_user_can_not_see_all_product()
    {
        $response = $this->get($this->getListProductRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_not_authorize_user_can_not_see_all_product()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get($this->getListProductRoute());
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function getListProductRoute()
    {
        return route('products.index');
    }
}
