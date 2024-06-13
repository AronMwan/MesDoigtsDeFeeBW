<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile($name)
    {
        $user = User::where('name', '=', $name)->firstOrFail();
        return view('users.profile', compact('user'));
    }

    public function updateBio(Request $request, $id)
    {
        $request->validate([
            'bio' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $user->bio = $request->bio;
        $user->save();

        return redirect()->route('profile', $user->name)->with('success', 'Bio updated successfully.');
    }

    public function edit($name)
    {
        $user = User::where('name', '=', $name)->firstOrFail();
        return view('users.edit', compact('user'));
    }

    public function admin()
    {
        $users = User::all();
        return view('users.admin', compact('users'));
    }

    public function promote($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();

        return redirect()->route('admin')->with('success', 'User promoted to admin.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|min:3',
            'birthday' => 'nullable|date',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->birthday = $validated['birthday'];
        $user->bio = $validated['bio'];

        if ($request->hasFile('avatar')) {
            // Verwijder de oude avatar als die bestaat
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            // Sla de nieuwe avatar op
            $avatarName = $user->id . '_avatar' . time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('avatars', $avatarName, 'public');
            $user->avatar = $avatarName;
        }

        $user->save();

        return redirect()->route('profile', $user->name)->with('status', 'Profile updated successfully');
    }


    
}
