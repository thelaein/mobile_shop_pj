<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function list()
    {
        $users = User::latest()->paginate(10);
        $role = "ALL";
        $variables = ['users','role'];
        return view('admin.user-list', compact($variables));
    }

    public function filterUser($filtered_role)
    {
        $role = $filtered_role;
        if($role == 'ALL'){
            $users = User::latest()
                ->paginate(10);
        } else {
            $users = User::latest()
                ->where('role', $role)
                ->paginate(10);
        }
        $variables = ['users','role'];
        return view('admin.user-list', compact($variables));
    }
}
