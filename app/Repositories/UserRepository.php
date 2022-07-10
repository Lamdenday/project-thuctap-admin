<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    /**
     * Get all user use scope
     * @return User
     *
     */
    public function search($dataSearch)
    {
        return $this->model->searchWithName($dataSearch['name'])->searchWithEmail($dataSearch['email'])
            ->searchWithRoleId($dataSearch['role_id'])->latest('id')->paginate(5);
    }

    /**
     * Get count user
     * @return numeric
     *
     */
    public function count()
    {
        return $this->model->count();
    }
}
