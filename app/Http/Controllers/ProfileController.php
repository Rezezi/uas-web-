<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Update name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle avatar upload if there is a file
        if ($request->hasFile('avatar')) {
            // Store the new avatar image in the 'avatars' directory within the 'public' disk
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            
            // Delete old avatar if it exists
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            // Update the avatar path in the database
            $user->avatar = $avatarPath;
        }

        // Save the user model (this is the correct method)
        $user->save();

        // Redirect back to the edit profile page with a success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
