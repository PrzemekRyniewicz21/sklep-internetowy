<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('users.index', [
            'users' => $this->userRepository->index()
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $this->userRepository->edit($user)
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return $this->userRepository->update($request, $user);
    }

    public function destroy(Request $request)
    {
        return $this->userRepository->destroy($request);
    }
}
