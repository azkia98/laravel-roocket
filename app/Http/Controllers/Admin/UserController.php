<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        auth()->loginUsingId(1);
        $this->authorize('show-users');
        $users = User::latest()->paginate(25);
        return view('Admin.users.all' , compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
