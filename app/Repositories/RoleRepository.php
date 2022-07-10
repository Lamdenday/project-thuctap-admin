<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return Role::class;
    }

    /**
     * Search Role
     * @param $dataSearch
     * @return Role
     */
    public function search($dataSearch)
    {
        return $this->model->withName($dataSearch['name'])->latest('id')->paginate(5);
    }

    /**
     * Get count role
     * @return numeric
     *
     */
    public function count()
    {
        return $this->model->count();
    }
}
