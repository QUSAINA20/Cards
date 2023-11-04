<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        \Config::set('auth.defaults.guard', 'admin-api');
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function store(UserRequest $request)
    {
        $request->validated();
        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => $request->status,
                'phone' => $request->phone,
                'balance' => $request->balance,
            ]
        );
        return response()->json('User stored successfully.', 200);
    }

    public function update(UserRequest $request, User $user)
    {
        $data =  $request->validated();
        $data['password'] = bcrypt($request->password);
        $user->update($data);
        return response()->json('User updated successfully.', 200);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json('User deleted successfully.', 200);
    }
    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 'Deactivated') {
            User::findOrFail($id)->update(['status' => 'Active']);
            return response()->json('User Status Is Active Now', 200);
        } else {
            User::findOrFail($id)->update(['status' => 'Deactivated']);
            return response()->json('User Status Is Deactivated Now', 200);
        }
    }
}
