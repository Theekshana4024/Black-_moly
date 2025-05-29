<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index(){
        $user = Auth::user();

        $user->load(['vehicles', 'transactions.vehicle']);
        return view('customer.pages.profile', compact('user'));

    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        // Update user basic info
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update or create user contact
        $userContact = $user->contacts()->first(); // Assuming 1 contact per user

        if (!$userContact) {
            $userContact = new \App\Models\UserContact();
            $userContact->user_id = $user->id;
        }

        $userContact->telephone = $request->phone;
        $userContact->address = $request->address;
        $userContact->save();

        return redirect()->route('profile.index', ['tab' => 'profile'])
            ->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile.index', ['tab' => 'password'])
                ->with('password_error', 'Current password is incorrect');
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.index', ['tab' => 'password'])
            ->with('password_success', 'Password updated successfully!');
    }

}
