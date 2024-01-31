<?php

namespace App\Interfaces;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function index();

    public function edit(User $user);

    public function update(UpdateUserRequest $request, User $user);

    public function destroy(Request $request);
}
