<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggotas = Anggota::all();
        return view('share.anggota.index', compact('anggotas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('share.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nama_pewaris' => 'nullable|string|max:255',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'nullable|date',
        ]);

        Anggota::create($request->all());

        return redirect()->route('share.anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        $users = User::doesntHave('anggota')->orWhere('id', $anggota->user_id)->get();
        return view('share.anggota.edit', compact('anggota', 'users'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:anggotas,email,' . $anggota->id,
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'nama_pewaris' => 'nullable|string|max:255',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'nullable|date',
        ]);

        $anggota->update($request->all());
        return redirect()->route('share.anggota.index')->with('success', 'Anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('share.anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
