<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\pinjam;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function index()
    {
        $angsurans = Angsuran::with('pinjam.anggota.user')->latest()->get();
        return view('share.angsuran.index', compact('angsurans'));
    }

//     public function create()
//     {
//         $pinjam_id = $request->query('pinjam_id'); // Ambil ID pinjaman dari URL
//         $pinjaman = Pinjam::with('anggota')->get(); // Ambil semua pinjaman

//         return view('share.pinjams.bayar', compact('pinjaman', 'pinjam_id'));
//     }


//         public function store(Request $request)
//     {
//         $request->validate([
//             'pinjam_id' => 'required|exists:pinjams,id',
//             'jumlah_bayar' => 'required|numeric|min:1',
//             'tanggal_bayar' => 'required|date',
//         ]);

//         $pinjaman = Pinjam::findOrFail($request->pinjam_id);

//         // Kurangi sisa pinjaman
//         $pinjaman->sisa_pinjaman -= $request->jumlah_bayar;
//         if ($pinjaman->sisa_pinjaman < 0) {
//             $pinjaman->sisa_pinjaman = 0;
//         }
//         $pinjaman->save();

//         // Simpan angsuran
//         Angsuran::create([
//             'pinjam_id' => $request->pinjam_id,
//             'jumlah_bayar' => $request->jumlah_bayar,
//             'tanggal_bayar' => $request->tanggal_bayar,
//         ]);

//         return redirect()->route('share.angsuran.index')->with('success', 'Pembayaran angsuran berhasil!');
//     }
}


