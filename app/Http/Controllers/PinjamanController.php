<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\angsuran;
use App\Models\Pembayaran;
use App\Models\pinjam;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua pinjaman dengan data anggota
        $pinjaman = Pinjam::with('anggota.user')->get();
        return view('share.pinjam.index',compact('pinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = anggota::all();
        return view('share.pinjam.create', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah' => 'required|numeric|min:1',
            'bunga' => 'required|numeric|min:0',
            'tenor' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'tanggal_pengajuan' => 'required|date',
            'tanggal_persetujuan' => 'nullable|date',
        ]);

        // Konversi koma ke titik
        $bunga = str_replace(',', '.', $request->bunga);

        Pinjam::create([
            'anggota_id' => $request->anggota_id,
            'jumlah' => $request->jumlah,
            'sisa_pinjaman' => $request->jumlah, // Awalnya sama dengan jumlah pinjaman
            'bunga' => $bunga,
            'tenor' => $request->tenor,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'tanggal_persetujuan' => $request->tanggal_persetujuan,
        ]);

        return redirect()->route('share.pinjam.index')->with('success', 'Pinjaman berhasil dibuat');
    }


    public function simulasi(Request $request)
    {
        $jumlah = $request->query('jumlah');
        $bunga = $request->query('bunga');
        $tenor = $request->query('tenor');

        $hasilSimulasi = [];
        $pokokPerBulan = round(($jumlah / $tenor) / 100) * 100;
        $sisaPokok = $jumlah;

        for ($bulan = 1; $bulan <= $tenor; $bulan++) {
            $bungaPerBulan = round(($sisaPokok * $bunga / 100) / 100) * 100;
            $totalBayar = $pokokPerBulan + $bungaPerBulan;

            // Gunakan sprintf untuk memastikan angka tampil dengan tiga nol di belakangnya
            $hasilSimulasi[] = [
                'bulan' => $bulan,
                'sisaPokok' => sprintf('%01.3f', $sisaPokok), // Format 000.000
                'bunga' => sprintf('%01.3f', $bungaPerBulan),
                'pokok' => sprintf('%01.3f', $pokokPerBulan),
                'total' => sprintf('%01.3f', $totalBayar),
            ];

            $sisaPokok -= $pokokPerBulan;
        }

        return view('share.pinjam.simulasi', compact('hasilSimulasi'));
    }



    private function hitungAngsuranMenurun($totalPinjaman, $bunga, $tenor)
    {
        $pokokPerBulan = round($totalPinjaman / $tenor, 0);  // Membulatkan pokok per bulan
        $sisaPokok = $totalPinjaman;
        $angsuran = [];

        for ($i = 1; $i <= $tenor; $i++) {
            $bungaBulan = round($sisaPokok * ($bunga / 100), 0);  // Membulatkan bunga per bulan
            $angsuranBulan = round($pokokPerBulan + $bungaBulan, 0);  // Pembulatan total angsuran per bulan

            // Membulatkan angka pokok dan bunga ke kelipatan terdekat 10.000
            $sisaPokok = round($sisaPokok, -2);  // Bulatkan sisa pokok ke kelipatan terdekat 1000

            $angsuran[] = [
                'bulan' => $i,
                'sisaPokok' => $sisaPokok,
                'bunga' => round($bungaBulan, -2),  // Bulatkan bunga ke kelipatan terdekat 1000
                'pokok' => round($pokokPerBulan, -2),  // Bulatkan pokok ke kelipatan terdekat 1000
                'total' => round($angsuranBulan, -2),  // Bulatkan total angsuran per bulan ke kelipatan terdekat 1000
            ];

            // Mengurangi sisa pokok dengan pokok per bulan
            $sisaPokok -= $pokokPerBulan;
        }

        return $angsuran;
    }

    public function detail($id)
    {
        $pinjaman = Pinjam::with(['anggota'])->findOrFail($id);

        // Melakukan perhitungan angsuran menurun
        $angsuran = $this->hitungAngsuranMenurun($pinjaman->jumlah, $pinjaman->bunga, $pinjaman->tenor);

        return view('/Pinjaman/detailpinjaman', compact('pinjaman', 'angsuran'));
    }
        /**
     * Display the specified resource.
     */
    public function bayar($id)
    {
        $pinjaman = Pinjam::with('anggota')->findOrFail($id);

        return view('share.pinjam.bayar', compact('pinjaman'));
    }

    public function storeBayar(Request $request, $id)
{
    $request->validate([
        'jumlah_bayar' => 'required|numeric|min:1',
    ]);

    // Ambil data pinjaman
    $pinjaman = Pinjam::findOrFail($id);

    // Cek apakah jumlah bayar melebihi sisa pinjaman
    if ($request->jumlah_bayar > $pinjaman->sisa_pinjaman) {
        return redirect()->back()->withErrors(['jumlah_bayar' => 'Jumlah pembayaran melebihi sisa pinjaman!']);
    }

    // Simpan transaksi pembayaran
    Pembayaran::create([
        'pinjam_id' => $id,
        'jumlah_bayar' => $request->jumlah_bayar,
        'tanggal_bayar' => now(),
    ]);

    // Kurangi sisa pinjaman
    $pinjaman->sisa_pinjaman -= $request->jumlah_bayar;
    $pinjaman->save();

    return redirect()->route('share.pinjam.index')->with('success', 'Pembayaran berhasil!');
}


public function riwayat($id)
{
    $pinjaman = Pinjam::with('anggota')->findOrFail($id);
    $transaksi = Pembayaran::where('pinjam_id', $id)->orderBy('tanggal_bayar', 'desc')->get();

    return view('share.pinjam.riwayat', compact('pinjaman', 'transaksi'));
}



    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $pinjaman = Pinjam::find($id); // Gunakan Pinjaman bukan Pinjam
    $anggota = Anggota::all();

    if (!$pinjaman) {
        abort(404, "Pinjaman dengan ID $id tidak ditemukan");
    }

    return view('share.pinjam.edit', compact('pinjaman', 'anggota'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{

    $validated = $request->validate([
        'anggota_id' => 'required|exists:anggotas,id',
        'jumlah' => 'required|numeric|min:1',
        'bunga' => 'required|numeric|min:0',
        'tenor' => 'required|integer|min:1',
        'tanggal_pinjam' => 'required|date',
        'tanggal_jatuh_tempo' => 'required|date',
        'tanggal_pengajuan' => 'required|date',
        'tanggal_persetujuan' => 'nullable|date',
    ]);

    $pinjaman = Pinjam::findOrFail($id);
    $pinjaman->update($validated);

    return redirect()->route('share.pinjam.index')->with('success', 'Data pinjaman berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $pinjaman = Pinjam::findOrFail($id);

    // Hapus semua angsuran terkait (jika masih ada relasi)
    Angsuran::where('pinjam_id', $pinjaman->id)->delete();

    // Hapus pinjaman
    $pinjaman->delete();

    return redirect()->route('share.pinjam.index')->with('success', 'Pinjaman berhasil dihapus.');
}
}
