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
        $user = Auth::User();

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
        $user = Auth::user();
    
        // Cek apakah ID yang sedang login sama dengan ID yang ingin diedit
        if ($user->id != $id) {
            return redirect()->route('siswa.profiles.show')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }
    
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

        // Ensure that only the logged-in user can update their own profile
        if (Auth::user()->id != $id) {
            return redirect()->route('siswa.profiles.show')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:255',
            'nohp' => 'nullable|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user fields
        $user->name = $request->input('name');
        $user->kelas = $request->input('kelas');
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
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $user->photo = $path;
        }

        // Save changes
        $user->save();

        // Redirect back to the profile page with success message
        return redirect()->route('siswa.profiles.show', $user->id)
                        ->with('success', 'Profile updated successfully');
    }
}
