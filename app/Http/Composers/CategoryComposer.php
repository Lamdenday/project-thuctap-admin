<?php

namespace App\Http\Composers;

use App\Repositories\CategoryRepository;
use Illuminate\View\View;

class CategoryComposer
{
    /**
     * The category repository implementation.
     *
     * @var CategoryRepository $categoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryRepository constructor
     *
     * @param CategoryRepository $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categoryRepository->all());
        $view->with('category_count', $this->categoryRepository->count());
    }
}
