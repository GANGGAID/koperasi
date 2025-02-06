<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.dashboard');
    }
    public function anggota() {
        return view('pegawai.anggota.index');
       }
    public function simpan() {
        return view('pegawai.simpan.index');
       }
   public function pinjam() {
       return view('pegawai.pinjam.index');
   }
   public function angsuran() {
       return view('pegawai.angsuran.index');
   }
   public function laporan() {
       return view('pegawai.laporan.index');
   }
}

