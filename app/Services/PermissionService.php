<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    /**
     * @var $permissionRepository
     */
    protected $permissionRepository;

    /**
     * RoleService constructor
     * @param PermissionRepository $permissionRepository
     *
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Get all permission
     * @return String
     *
     */
    public function all()
    {
        return $this->permissionRepository->all();
    }
}
