<?php

namespace App\Http\Composers;

use App\Repositories\RoleRepository;
use Illuminate\View\View;

class RoleComposer
{
    /**
     * The role repository implementation.
     *
     * @var RoleRepository $roleRepository
     */
    protected $roleRepository;

    /**
     * Create a new profile composer.
     *
     * @param RoleRepository $roleRepository
     * @return void
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('roles', $this->roleRepository->all());
        $view->with('role_count', $this->roleRepository->count());
    }
}
