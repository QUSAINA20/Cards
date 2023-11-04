<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        \Config::set('auth.defaults.guard', 'admin-api');
    }

    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }
    public function store(AdminRequest $request)
    {
        $request->validated();
        Admin::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => $request->status,
                'phone' => $request->phone,
            ]
        );
        return response()->json('Admin stored successfully.', 200);
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $data =  $request->validated();
        $data['password'] = bcrypt($request->password);
        $admin->update($data);
        return response()->json('Admin updated successfully.', 200);
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return response()->json('Admin deleted successfully.', 200);
    }
    public function changeStatus($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->status == 'Deactivated') {
            Admin::findOrFail($id)->update(['status' => 'Active']);
            return response()->json('Admin Status Is Active Now', 200);
        } else {
            Admin::findOrFail($id)->update(['status' => 'Deactivated']);
            return response()->json('Admin Status Is Deactivated Now', 200);
        }
    }
}
