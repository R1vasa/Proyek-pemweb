<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SessionController extends Controller
{
    public function index()
    {
        return view('Auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // Check if the user is banned
            $user = Auth::user();
            if ($user->role === 'banned') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Akun anda telah dibanned.',
                ]);
            }

            // Redirect based on user role
            return $user->role === 'admin' ? redirect('admin') : redirect('home');
        } else {
            return redirect()->back()->withErrors('Email/Username atau Password salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function register()
    {
        return view('Auth/register');
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Masukkan email yang valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile' => 'profiles/default.png',
        ]);

        Auth::login($user);
        return redirect('/register/profile');
    }

    public function showProfileForm()
    {
        $user = Auth::user();

    if ($user->username) {
        return redirect('/home');
    }

        return view('Auth/profile');
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect('/login')->withErrors('Silakan login terlebih dahulu.');
        }

        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'profile' => 'nullable|image|max:2048',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'profile.image' => 'File harus berupa gambar',
            'profile.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('profile')) {
            if ($user->profile && Storage::disk('public')->exists($user->profile) && $user->profile !== 'profiles/default.png') {
                Storage::disk('public')->delete($user->profile);
            }
            $path = $request->file('profile')->store('profiles', 'public');
            $user->profile = $path;
        }

        $user->username = $request->username;
        $user->save();

        return redirect('/home')->with('success', 'Profil berhasil diperbarui!');
    }
}
