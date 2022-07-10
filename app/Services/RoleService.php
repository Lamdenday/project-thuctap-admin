<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function search($request)
    {
        $dataSearch = $request->all();
        $dataSearch['name'] = $request->name ?? '';
        return $this->roleRepository->search($dataSearch);
    }

    public function create($request)
    {
        $dataCreate = $request->all();
        $dataCreate['permission'] = $request->permission ?? [];
        $role = $this->roleRepository->create($dataCreate);
        $role->attachPermission($dataCreate['permission']);
        return $role;
    }

    public function findOrFail($id)
    {
        return $this->roleRepository->findOrFail($id);
    }

    public function update($request, $id)
    {
        $role = $this->roleRepository->find($id);
        $dataUpdate = $request->all();
        $dataCreate['permission'] = $request->permission ?? [];
        $role->update($dataUpdate);
        $role->syncPermission($dataCreate['permission']);
        return $role;
    }

    public function delete($id)
    {
        $role = $this->roleRepository->find($id);
        $role->detachUser();
        $role->detachPermission();
        $role->delete();
        return true;
    }
}
