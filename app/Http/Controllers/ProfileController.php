<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'gender' => ['nullable', 'in:male,female,other'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'gender' => $validated['gender'] ?? null,
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
