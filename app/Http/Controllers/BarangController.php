<?php

namespace App\Http\Controllers;

use App\Imports\BarangImport;
use App\Models\Barang;
use App\Models\TipeBarang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::with('tipe_barang')->get();
        $kode_barang_only = Barang::select('kode_barang')->get();
        return view('admin.master.barang_gudang', ['title' => 'Barang Gudang'], compact('barangs', 'kode_barang_only'));
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file_barang' => 'mimes:xls,xlsx'
        ], [
            'file_barang.mimes' => 'File ditolak, hanya menerima file excel'
        ]);
        $data = $request->file('file_barang');
        $file_name = $data->getClientOriginalName();
        $data->move('Data_Barang', $file_name);
        Excel::import(new BarangImport(), \public_path('/Data_Barang/' . $file_name));
        $data_barang = Barang::all();

        // Pengosongan Semua Stok
        foreach($data_barang as $item){
            $tipe_barang = TipeBarang::where('id', $item->tipe_barang_id)->first();
            $tipe_barang->update(['total_stok' => 0]);
        }

        // Hitung Ulang Semua Stok
        foreach($data_barang as $item){
            $tipe_barang = TipeBarang::where('id', $item->tipe_barang_id)->first();
            $stok_sekarang = $tipe_barang->total_stok;
            $tipe_barang->update([
                'total_stok' => $stok_sekarang + $item->jumlah_satuan
            ]);
        }

        return back()->with('success', 'Data Barang Berhasil Di Import');
    }

    public function exportData(){
        $barangs = Barang::with('tipe_barang')->get();
        $tipe_barangs = TipeBarang::all();
        $title = "Export Data Barang";
        return view('admin.master.barang_gudang_export', compact('title', 'barangs', 'tipe_barangs'));
    }

    public function cetak(Request $request)
    {
        $kode_barangs = Barang::select('kode_barang')->get();
        $kode = $request->kode;
        $title = $kode == 'qrcode' ? 'Cetak QRCode Barang' : 'Cetak Barcode Barang';
        return view('admin.master.kode_barang_cetak', compact('kode_barangs', 'kode', 'title'));
    }

    public function show($id)
    {
        $tipe_barang = Barang::where('id', $id)->first();
        return response()->json($tipe_barang, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan_barang' => 'required',
            'jumlah_satuan' => 'required',
            'tipe_barang_id' => 'required',
        ]);

        $tipe_barang = TipeBarang::where('id', $request->tipe_barang_id)->first();

        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan_barang' => $request->satuan_barang,
            'jumlah_satuan' => $request->jumlah_satuan,
            'status_barang' => 'ada',
            'tipe_barang_id' => $request->tipe_barang_id,
        ]);

        $tipe_barang->update(['total_stok' => $tipe_barang->total_stok + $request->jumlah_satuan]);
        return back()->with('success', 'Barang baru berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::where('id', $id)->first();
        $tipe_barang = TipeBarang::where('id', $request->tipe_barang_id)->first();
        $selisih_stok = $request->jumlah_satuan - $barang->jumlah_satuan;

        // Add
        if ($barang->jumlah_satuan < $request->jumlah_satuan) {
            $tipe_barang->update([
                'total_stok' => $tipe_barang->total_stok + $selisih_stok,
            ]);
        }

        // Substract
        if ($barang->jumlah_satuan > $request->jumlah_satuan) {
            $tipe_barang->update([
                'total_stok' => $tipe_barang->total_stok - $request->jumlah_satuan,
            ]);
        }

        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan_barang' => $request->satuan_barang,
            'jumlah_satuan' => $request->jumlah_satuan,
            'tipe_barang_id' => $request->tipe_barang_id,
        ]);

        return back()->with('success', 'Barang tersebut berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $barang = Barang::where('id', $id)->first();
        $tipe_barang = TipeBarang::where('id', $barang->tipe_barang_id)->first();
        if ($barang) {
            if ($barang['status_barang'] == 'dipinjam') {
                return back()->with('failed', 'Tidak dapat menghapus barang yang dipinjam');
            } else {
                $tipe_barang->update(['total_stok' => $tipe_barang->total_stok - $barang->jumlah_satuan]);
                $barang->delete();
                return back()->with('success', 'Barang dihapus');
            }
        } else {
            return back()->with('failed', 'Barang tidak ditemukan');
        }
    }
}
