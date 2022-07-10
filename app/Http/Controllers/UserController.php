<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\EditUserRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('users.index');
    }

    public function list(Request $request)
    {
        $users = $this->userService->search($request);
        return view('users.list', compact('users'))->render();
    }

    public function store(CreateUserRequest $request)
    {
        $data = $this->userService->create($request);
        return $this->sentSuccessResponse($data, 'Create user success', Response::HTTP_CREATED);
    }

    public function edit($id)
    {
        $user = $this->userService->findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(EditUserRequest $request, $id)
    {
        $data = $this->userService->update($request, $id);
        return $this->sentSuccessResponse($data, 'Edit user success', Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->userService->delete($id);
        return $this->sentSuccessResponse('', 'Delete user success', Response::HTTP_NO_CONTENT);
    }
}
