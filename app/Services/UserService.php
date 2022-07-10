<?php

namespace App\Services;

use App\Repositories\UserRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function search($request)
    {
        $dataSearch = $request->all();
        $dataSearch['name'] = $request->name ?? '';
        $dataSearch['email'] = $request->email ?? '';
        $dataSearch['role_id'] = $request->role_id ?? '';
        return $this->userRepository->search($dataSearch);
    }

    public function findOrFail($id)
    {
        return $this->userRepository->findOrFail($id);
    }

    public function create($request)
    {
        $dataCreate = $request->all();
        $dataCreate['password'] = Hash::make($request->password);
        $user = $this->userRepository->create($dataCreate);
        $user->attachRole($request->roles);
        return $user;
    }

    public function update($request, $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $dataUpdate = $request->except('password');
        if ($request->password) {
            $dataUpdate['password'] = Hash::make($request->password);
        }
        $user->update($dataUpdate);
        $user->syncRole($request->roles);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->userRepository->findOrFail($id);
        $user->detachRole();
        $user->delete();
        return true;
    }
}
