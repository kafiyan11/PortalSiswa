<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Ensure the User model is used

class ProfileController extends Controller
{
    /**
     * Display the profile page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Redirect to the 'profil.blade.php' view with user data
        return view('siswa.profiles.profil', compact('user'));
    }

    /**
     * Show the form for editing the profile.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Ensure that only the logged-in user can edit their own profile
        $user = Auth::user();

        if ($user->id != $id) {
            return redirect()->route('siswa.profiles.profil')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }

        // Show the edit profile form with user data
        return view('siswa.profiles.edit', compact('user'));
    }

    /**
     * Update the profile changes in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID or fail
        $user = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50', // Add validation for kelas
            'alamat' => 'nullable|string|max:255',
            'nohp' => 'nullable|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        // Update user fields
        $user->name = $request->input('name');
        $user->kelas = $request->input('kelas'); // Update kelas
        $user->alamat = $request->input('alamat');
        $user->nohp = $request->input('nohp');

        // Handle profile photo
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            // Save the new photo
            $file = $request->file('photo');
            $path = $file->store('profile_photos', 'public');
            $user->photo = $path;
        }

        // Save changes to the database
        $user->save();

        // Redirect back to the profile page with success message
        return redirect()->route('profiles.show', $user->id)
                         ->with('success', 'Profile updated successfully');
    }
}
