<?php

namespace App\Http\Composers;

use App\Repositories\ProductRepository;
use Illuminate\View\View;

class ProductComposer
{
    /**
     * The product repository implementation.
     *
     * @var ProductRepository $productRepository
     */
    protected $productRepository;

    /**
     * Create a new profile composer.
     *
     * @param ProductRepository $productRepository
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('product_count', $this->productRepository->count());
    }
}
