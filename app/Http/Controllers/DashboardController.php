<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = User::where('password' , NULL)->count();
        $barangs = Barang::count();
        $pinjam_total_count = Pinjam::with('user', 'barang', 'tahun_ajaran')->where('waktu_kembali', NULL)->count();
        $pinjams = Pinjam::take(5)->with('user', 'barang', 'tahun_ajaran')->where('waktu_kembali', NULL)->latest()->get();
        return view('admin.index', ['title' => 'Dashboard'], compact('users', 'barangs', 'pinjams', 'pinjam_total_count'));
    }

    public function terpinjam(){
        $barang_pinjams = Pinjam::with('user', 'barang', 'tahun_ajaran')->where('waktu_kembali', null)->latest()->get();
        return view('admin.transaksi.barang_terpinjam', ['title' => 'Barang Yang Di Pinjam'], compact('barang_pinjams'));
    }

    public function kembali(){
        $barang_kembalis = Pinjam::with('user', 'barang', 'tahun_ajaran')->where('waktu_kembali', "!=" , null)->latest()->get();
        return view('admin.transaksi.barang_kembali', ['title' => 'Barang Yang Telah Kembali'], compact('barang_kembalis'));
    }

    public function pinjamCetak(){
        $barang_pinjams = Pinjam::with('user', 'barang')->where('waktu_kembali', NULL)->latest()->get();
        $title = "Laporan Data Barang Di Pinjam Belum Dikembalikan";
        return view('admin.transaksi.barang_terpinjam_export', ['title' => 'Laporan Barang Di Pinjam Belum Dikembalikan'], compact('barang_pinjams'));
    }
}
