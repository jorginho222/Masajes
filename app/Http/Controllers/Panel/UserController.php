<?php

namespace App\Http\Controllers\Panel;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('panel.users.index')->with([
            'users' => User::all(),
        ]);
    }

    public function toggleAdmin(User $user)
    {
        if ($user->isAdmin()) {
            $user->admin_since = null;
        } else {
            $user->admin_since = now();
        }
        $user->save();

        return redirect()
            ->route('users.index')
            ->withSuccess("El rol del usuario con id {$user->id} ha sido modificado.");
    }
}
