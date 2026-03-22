<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'profile_photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $photo = $request->file('profile_photo')->store('profile', 'public');

            $user->profile_photo = $photo;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        if ($user->role === 'buyer') {
            return redirect()->route('shop.index')->with('status', 'profile-updated');
        } elseif ($user->role === 'seller') {
            return redirect()->route('seller.dashboard')->with('status', 'profile-updated');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('status', 'profile-updated');
        }
        
        return redirect()->back()->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
