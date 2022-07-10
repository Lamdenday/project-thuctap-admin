<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }

    /**
     * Get Permission by group
     *
     * @param $id
     * @return String
     *
     */
    public function getWithGroup()
    {
        return $this->model->all()->groupBy('group_name');
    }
}
