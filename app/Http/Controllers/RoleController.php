<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\EditRoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    protected $roleService;
    protected $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function index(Request $request)
    {
        $roles = $this->roleService->search($request);
        $permission = $this->permissionService->all();
        return view('roles.index', [
            'roles' => $roles,
            'permission' => $permission,
        ]);
    }

    public function create()
    {
        $permission = $this->permissionService->all();
        return view('roles.create', compact('permission'));
    }

    public function store(CreateRoleRequest $request)
    {
        $this->roleService->create($request);
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        $role = $this->roleService->findOrFail($id);
        return view('roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = $this->roleService->findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update(EditRoleRequest $request, $id)
    {
        $this->roleService->update($request, $id);
        return redirect(route('roles.index'))
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $this->roleService->delete($id);
        return response()->json([
            'message' => 'Delete Role Success'
        ], Response::HTTP_NO_CONTENT);
    }
}
