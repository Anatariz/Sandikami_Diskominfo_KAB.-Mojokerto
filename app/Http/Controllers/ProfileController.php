<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $layanans = $user->role !== 'admin' ? $user->layanans()->latest()->get() : collect();
        $pengaduans = $user->role !== 'admin' ? $user->pengaduans()->latest()->get() : collect();
        return view('profile.show', compact('user', 'layanans', 'pengaduans'));
    }

    public function edit()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('profile.show');
        }
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('profile.show');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'jabatan' => 'nullable|string|max:255',
            'divisi' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|required_with:current_password|string|min:8|confirmed',
        ]);

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Handle Password Update
        if ($request->filled('current_password')) {
            if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        }

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->jabatan = $validated['jabatan'] ?? null;
        $user->divisi = $validated['divisi'] ?? null;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}
