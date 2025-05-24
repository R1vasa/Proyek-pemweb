<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::all(); 
        $totalUsers = User::count();
        return view('pages/AdminDashboard', compact('user', 'totalUsers'));
    }

    public function destroy($id)
{
    $user = User::findOrFail($id); // Mencari user berdasarkan ID
    $user->delete(); // Menghapus user
    return redirect()->back()->with('success', 'User berhasil dihapus.'); // Redirect kembali dengan pesan sukses
}



}
