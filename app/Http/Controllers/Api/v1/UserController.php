<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserCollection($this->userService->findAllUsers());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegisterRequest $request)
    {
        return new UserResource($this->userService->createUser(
            new UserDto($request->name, $request->email, $request->password)
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new UserResource($this->userService->findUser($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        return new UserResource($this->userService->updateUser($id, new UserDto($request->name, $request->email)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);
        return response()->json(['message' => 'Usuário Excluído!'], 202);
    }
}
