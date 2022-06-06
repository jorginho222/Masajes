<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('user.profile.edit')->with([
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileRequest $request)
    {
        
        $user = $request->user();

        $user->fill(array_filter($request->validated())); // array_filter(): solo actualizaremos lo q el usuario haya editado

        if($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        if($request->hasFile('image')) {
            if($user->image != null) {
                Storage::disk('images')->delete($user->image->path);
                $user->image->delete();
            }

            $user->image()->create([
                'path' => 'images/' . $request->image->store('users', 'images'),
            ]);
        }
        
        return redirect()
            ->route('profile.edit')
            ->withSuccess('El perfil se editó correctamente.');
    }
}

