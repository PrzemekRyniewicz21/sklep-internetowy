<?php

namespace App\Repositories;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {
        return $this->model->paginate(3);
    }

    public function edit(User $user)
    {
        return $user;
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $addressValidated = $request->validated()['address'];

        if ($user->hasAddress()) {
            $address = $user->address;
            $address->fill($addressValidated);
        } else {
            $address = new Address($addressValidated);
        }
        $user->address()->save($address);

        return redirect(route('users.index'))->with('status', 'product stored');
    }

    public function destroy(Request $request)
    {
        $this->model->find($request->user_id)->delete();

        return redirect(route('users.index'))->with(['msg' => 'User Deleted']);
    }
}
