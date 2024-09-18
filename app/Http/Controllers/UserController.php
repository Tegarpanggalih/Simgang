<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:tbl_login,username',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'pass' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($id);

        // Return the edit view with the user data
        return view('users.edit', compact('user'));
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|unique:tbl_login,username,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Prepare data for update
        $data = [
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $data['pass'] = Hash::make($request->password);
        }

        // Update the user
        $user->update($data);

        // Redirect with success message
        return redirect()->route('user.index')->with('success', 'User berhasil diupdate.');
    }


    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
