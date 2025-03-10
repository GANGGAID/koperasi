<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Simpan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimpananController extends Controller
{

public function index()
{
    $simpans = Simpan::select(
            'anggota_id',
            'jenis',
            DB::raw('(SELECT id FROM simpans s2 WHERE s2.anggota_id = simpans.anggota_id AND s2.jenis = simpans.jenis ORDER BY s2.tanggal DESC LIMIT 1) as id_terbaru'),
            DB::raw('SUM(jumlah) as total_jumlah'),
            DB::raw('MAX(tanggal) as tanggal_terbaru')
        )
        ->groupBy('anggota_id', 'jenis')
        ->with('anggota') // Tetap ambil data anggota
        ->get();

    return view('share.simpan.index', compact('simpans'));
}



    public function create(Request $request)
{
    $anggotaId = $request->input('anggota_id');
    $anggotaTerpilih = null;
    $semuaAnggota = Anggota::all(); // Ambil semua anggota untuk dropdown

    if ($anggotaId) {
        $anggotaTerpilih = Anggota::find($anggotaId);
    }

    return view('share.simpan.create', compact('anggotaTerpilih', 'semuaAnggota'));
}


    public function store(Request $request)
    {
         $validated = $request->validate([
             'anggota_id' => 'required|exists:anggotas,id',
             'jenis'      => 'required|string|max:50',
             'jumlah'     => 'required|numeric|min:0',
             'tanggal'    => 'required|date',
         ]);

        Simpan::create($validated);
        return redirect()->route('share.simpan.index')->with('success', 'Simpanan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $simpan = Simpan::with('anggota')->findOrFail($id);
        return view('share.simpan.show', compact('simpan'));
    }

    public function edit($id)
    {
        $simpan = Simpan::findOrFail($id);
        $anggota = Anggota::all();
        return view('share.simpan.edit', compact('simpan', 'anggota'));
    }

    public function tarik($id)
    {
        $simpan = Simpan::findOrFail($id);
        return view('share.simpan.tarik', compact('simpan'));
    }

    public function prosesPenarikan(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
        ]);

        $simpan = Simpan::findOrFail($id);

        if ($request->jumlah > $simpan->jumlah) {
            return back()->withErrors(['jumlah' => 'Penarikan melebihi saldo simpanan.']);
    }

        $simpan->decrement('jumlah', $request->jumlah);

        return redirect()->route('share.simpan.index')->with('success', 'Penarikan berhasil diproses.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis'      => 'required|string|max:50',
            'jumlah'     => 'required|numeric|min:0',
            'tanggal'    => 'required|date',
        ]);

        $simpan = Simpan::findOrFail($id);
        $simpan->update($validated);
        return redirect()->route('share.simpan.index')->with('success', 'Data simpanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $simpan = Simpan::findOrFail($id);
        $simpan->delete();
        return redirect()->route('share.simpan.index')->with('success', 'Simpanan berhasil dihapus.');
    }

    public function riwayat($id)
{
    $simpanan = Simpan::with('anggota')->findOrFail($id);

    $riwayat = Simpan::where('anggota_id', $simpanan->anggota_id)
                ->orderBy('tanggal', 'desc')
                ->get();

                $total_simpanan_pokok = $riwayat->filter(function ($item) {
                    return $item->jenis === 'Pokok';
                })->sum('jumlah');

                $total_simpanan_wajib = $riwayat->filter(function ($item) {
                    return $item->jenis === 'Wajib';
                })->sum('jumlah');


    return view('share.simpan.riwayat', compact('simpanan', 'riwayat', 'total_simpanan_pokok', 'total_simpanan_wajib'));
}


}
