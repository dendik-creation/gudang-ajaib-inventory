<?php

namespace App\Http\Controllers;

use App\Models\TipeBarang;
use Illuminate\Http\Request;

class TipeBarangController extends Controller
{
    public function index(){
        $tipe_barangs = TipeBarang::all();
        return response()->json($tipe_barangs, 200);
    }

    public function webIndex(){
        $tipe_barangs = TipeBarang::all();
        return view('admin.master.stok_barang', ['title' => 'Total Stok'], compact('tipe_barangs'));
    }

    public function show($id){
        $tipe_barang = TipeBarang::where('id', $id)->first();
        return response()->json($tipe_barang, 200);
    }

    public function store(Request $request){
        $request->validate([
            'tipe_barang' => 'required',
        ]);
        TipeBarang::create([
            'tipe_barang' => $request->tipe_barang,
            'total_stok' => 0,
        ]);

        return back()->with('success', 'Tipe barang baru berhasil dibuat');
    }

    public function update($id, Request $request){
        $tipe_barang = TipeBarang::where('id', $id)->first();
        if($tipe_barang){
            $tipe_barang->update($request->all());
            return back()->with('success', 'Tipe barang tersebut berhasil diperbarui');
        }
    }

    public function destroy($id){
        $tipe_barang = TipeBarang::where('id', $id)->first();
        if($tipe_barang){
            $tipe_barang->delete();
            return back()->with('success', 'Tipe barang berhasil dihapus');
        }
    }
}
