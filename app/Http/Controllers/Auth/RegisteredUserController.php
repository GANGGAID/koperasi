<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function showRegistrationForm(Request $request)
    {
        // Ambil data nama dan email dari request
        $nama = $request->query('nama', '');
        $email = $request->query('email', '');

        return view('auth.register', compact('nama', 'email'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,pegawai,anggota'],
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // Jika admin yang sedang login mendaftarkan anggota, arahkan ke halaman form create anggota
        if (Auth::check() && Auth::user()->role === 'admin' && $request->role === 'anggota') {
            return redirect()->route('share.anggota.create')->with('success', 'Silakan lengkapi data anggota yang baru didaftarkan.');
        }

        // Jika admin menambahkan pengguna lain (pegawai/admin), kembali ke halaman Master Data
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.master-data.index')->with('success', 'Pengguna berhasil ditambahkan!');
        }

        // Login user yang baru saja mendaftar sendiri
        Auth::login($user);

        // Jika yang mendaftar sendiri adalah anggota, arahkan ke halaman create anggota
        if ($user->role === 'anggota') {
            return redirect()->route('share.anggota.create')->with('success', 'Silakan lengkapi data anggota Anda.');
        }

        // Default redirect ke dashboard
        return redirect(RouteServiceProvider::HOME);
    }
}
