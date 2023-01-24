<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $users = User::find(Auth::id());
        if (empty($users)) {
        abort(404);    
        }
        return view('admin.profile.edit', ['users_form' => $users]);
    }
}
