<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\TipeBarang;
use Illuminate\Http\Request;

class PinjamKembaliController extends Controller
{
    public function pinjamIndex()
    {
        return view('siswa.pinjam.pinjam', ['title' => "Peminjaman Barang"]);
    }

    public function kembaliIndex()
    {
        return view('siswa.kembalikan.kembalikan', ['title' => "Pengembalian Barang"]);
    }

    public function pinjamConfirm(Request $request)
    {
        $siswa = User::with('kelas')->where('nis', $request->nis)->first();
        if($siswa){
            return view('siswa.pinjam.pinjam_confirm', ['title' => "Konfirmasi Peminjaman", 'data' => $siswa]);
        }else{
            return back()->with('failed', 'NIS Tidak Ditemukan');
        }
    }

    public function kembaliConfirm(Request $request)
    {
        $siswa = User::with('kelas')->where('nis', $request->nis)->first();
        if($siswa){
            $barang_pinjaman = Pinjam::with('user', 'barang', 'tahun_ajaran')->where('user_id', $siswa->id)->where('waktu_kembali', null)->get();
            if($barang_pinjaman->count() > 0){
                return view('siswa.kembalikan.kembalikan_confirm', ['title' => "Konfirmasi Pengembalian", 'data' => $siswa, 'barangs' => $barang_pinjaman]);
            }else{
                return redirect('/')->with('success', 'Tidak ada barang yang dipinjam');
            }
        }else{
            return back()->with('failed', 'NIS Tidak Ditemukan');
        }
    }

    public function pinjamStore(Request $request){
        $request->validate([
            'user_id' => 'required',
            'data' => 'required',
        ]);
        $today = Carbon::now();
        foreach ($request->data as $item){
            $tahun_ajaran = 1;
            $barang = Barang::with('tipe_barang')->where('kode_barang', $item)->first();
            $barang->update(['status_barang' => 'dipinjam']);
            Pinjam::create([
                'user_id' => $request->user_id,
                'barang_id' => $barang->id,
                'tahun_ajaran_id' => $today->year == '2023' ? 1 : $tahun_ajaran++,
                'waktu_pinjam' => $today,
                'keterangan' => $request->keterangan,
            ]);
            $tipe_barang = TipeBarang::where('id', $barang->tipe_barang->id)->first();
            $tipe_barang->update([
                'total_stok' => $tipe_barang->total_stok - $barang->jumlah_satuan
            ]);
        }
        return redirect('/')->with('success', 'Kamu telah meminjam barang, Harap mengembalikan setelah menggunakan');
    }

    public function kembaliStore(Request $request){
        $request->validate([
            'kode_barang' => 'required',
            'pinjam_id' => 'required',
        ]);
        $today = Carbon::now();
        $barang = Barang::with('tipe_barang')->where('kode_barang', $request->kode_barang)->first();
        $pinjam = Pinjam::where('id', $request->pinjam_id)->first();

        // Ultimate Decision
        if($barang && $barang->status_barang == 'dipinjam' && $pinjam->waktu_kembali == NULL){
            $tipe_barang = TipeBarang::where('id', $barang->tipe_barang_id)->first();
            $stok_sekarang = $tipe_barang->total_stok;
            $tipe_barang->update([
                'total_stok' => $stok_sekarang + $barang->jumlah_satuan
            ]);
            $barang->update(['status_barang' => 'ada']);
            if($pinjam){
                $pinjam->update([
                    'waktu_kembali' => $today,
                ]);
                return back()->with('success', 'Barang telah dikembalikan');
            }else{
                return back()->with('failed', 'Kamu tidak meminjam barang tersebut');
            }

        }else{
            return back()->with('failed', 'Kamu tidak meminjam barang tersebut');
        }
    }

    function barangCheck(Request $request){
        $request->validate([
            'kode_barang' => 'required',
        ]);
        $barang = Barang::with('tipe_barang')->where('kode_barang',$request->kode_barang)->first();
        if($barang){
            if($barang->status_barang == 'ada'){
                return $barang;
            }
            else{
                return response()->json("Barang sedang dipinjam oleh siswa lain", 405);
            }
        }else{
            return response()->json("Barang yang dimaksud tidak ada", 404);
        }
    }
}
