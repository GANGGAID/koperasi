<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\anggota;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');

    }
    public function anggota() {
        $anggotas = User::where('role', 'anggota')->paginate(10);
        return view('admin.anggota.index', compact('anggotas'));
    }

    public function simpan() {
         return view('admin.simpan.index');
        }
    public function pinjam() {
        return view('admin.pinjam.index');
    }
    public function angsuran() {
        return view('admin.angsuran.index');
    }
    public function laporan() {
        return view('admin.laporan.index');
    }

    // MASTER DATA CONTROLLER
    public function masterData() {
        $users = User::paginate(10);
        return view('admin.master-data.index', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string',
        ]);

        // Buat pengguna tanpa login otomatis
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // Jika admin yang menambahkan, kembali ke halaman master data
        if (auth()->user()->role === 'admin') {
            return redirect()->route('master.index')->with('success', 'Pengguna berhasil ditambahkan!');
        }

        // Jika pengguna biasa yang mendaftar, tetap arahkan ke dashboard
        return redirect(RouteServiceProvider::HOME);
    }

   // END MASETR DATA CONTROLLER
}
