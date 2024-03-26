<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends ApiController
{

    public function doLogin(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        // $user = User::where('name', $credentials['name'])->first();
        // if (! $user || ! Hash::check($credentials['password'], $user->password)) {
        if (! Auth::attempt($credentials)) {
            return $this->error("!");
        }
        /**
         * @var User $user
         */
        $user = Auth::user();
        $token = $user->createToken('api', ['api'])->plainTextToken;
        $user['token'] = $token;
        return $this->success($user->toarray(), 'login successful');
    }


    public
    function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'unique:users,name', 'between:3,20'], // 确保用户名唯一
            'password' => ['required', 'confirmed:confirm_password', Password::min(6)]
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['email'] = $data['name'] . "@temp.com";

        // 创建用户
        $user = User::create($data);

        return $this->success($user, "registration success");
    }

    public
    function logout(Request $request): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        // Auth::user()->tokens()->delete(); //删除该用户所有token
        return $this->success([], "exit successfully");
    }
}
