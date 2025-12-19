<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest\StoreUserRequest;
use App\Http\Requests\UserRequest\UpdateUserRequest;
use App\Http\Resources\UserResource;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return UserResource::collection(
            User::orderBy("created_at", "asc")->paginate(1)
        );

    } 
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response(new UserResource($user), 201);
    }
    public function show(User $user)
    {
        return new UserResource($user);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return response("", 204);
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        $user = User::findOrFail($id);
        $user->update($data);
        return response()->json([
            'message' => 'Cập nhật thành công'
        ], 200);
    }
}
