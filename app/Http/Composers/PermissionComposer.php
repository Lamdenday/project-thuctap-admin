<?php

namespace App\Http\Composers;

use App\Repositories\PermissionRepository;
use Illuminate\View\View;

class PermissionComposer
{
    /**
     * The permission repository implementation.
     *
     * @var PermissionRepository $permission
     */
    protected $permission;

    /**
     * Create a new profile composer.
     *
     * @param PermissionRepository $permission
     * @return void
     */
    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('permissionGroup', $this->permission->getWithGroup());
    }
}
