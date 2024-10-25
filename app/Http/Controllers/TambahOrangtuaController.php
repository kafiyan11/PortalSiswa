<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class TambahOrangtuaController extends Controller
{
    /**
     * Menampilkan daftar orang tua dengan opsi pencarian.
     */
    public function index(Request $request)
    {
        // Get the search term from the request
        $search = $request->input('search');

        // Retrieve the parents based on the search term
        $orang = User::where('role', 'Orang Tua')
                     ->when($search, function ($query, $search) {
                         return $query->where(function($q) use ($search) {
                             $q->where('name', 'like', "%{$search}%")
                               ->orWhere('nis', 'like', "%{$search}%");
                         });
                     })
                     ->paginate(5);

        // Count total Orang Tua with caching
        $totalOrangTua = Cache::remember('total_orangtua_count', 60, function () {
            return User::where('role', 'Orang Tua')->count();
        });

        // Fetch the authenticated user
        $user = Auth::user();

        // Retrieve the students associated with the authenticated user
        $students = $user->children; // Adjust according to your relationship

        // Return the view with the necessary data
        return view('admin.tambahortu.ortu', [
            'orang' => $orang,
            'search' => $search,
            'totalOrangTua' => $totalOrangTua,
            'students' => $students // Pass the students to the view
        ]);
    }

    /**
     * Menyimpan data orang tua baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis',
            'password' => 'required|string|min:6|confirmed',
            'students' => 'nullable|array|max:2',
            'students.*' => 'exists:users,id',
        ]);

        $parent = User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password,
            'role' => 'Orang Tua',
        ]);

        Cache::forget('total_orangtua_count');

        if ($request->has('students')) {
            $parent->children()->attach($request->students);
        }

        return redirect()->route('ortu')->with('success', 'Akun Orang Tua berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk membuat orang tua baru.
     */
    public function create()
    {
        $students = User::where('role', 'Siswa')->get();

        return view('admin.tambahortu.createortu', compact('students'));
    }

    /**
     * Menampilkan form edit orang tua.
     */
    public function edit($id)
    {
        $parent = User::findOrFail($id);
        $students = User::where('role', 'Siswa')->get();

        return view('admin.tambahortu.editortu', compact('parent', 'students'));
    }

    /**
     * Memperbarui data orang tua yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'students' => 'nullable|array|max:2',
            'students.*' => 'exists:users,id',
        ]);

        $parent = User::findOrFail($id);

        $updateData = [
            'name' => $request->name,
            'nis' => $request->nis,
            'role' => 'Orang Tua',
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
            $updateData['plain_password'] = $request->password;
        }

        $parent->update($updateData);
        Cache::forget('total_orangtua_count');

        if ($request->has('students')) {
            $parent->children()->sync($request->students);
        } else {
            $parent->children()->sync([]);
        }

        return redirect()->route('ortu')->with('success', 'Akun Orang Tua berhasil diedit');
    }

    /**
     * Menghapus akun orang tua.
     */
    public function delet($id)
    {
        $parent = User::findOrFail($id);
        $parent->delete();

        Cache::forget('total_orangtua_count');

        return redirect()->route('ortu')->with('success', 'Akun Orang Tua berhasil dihapus');
    }
}
