<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(){
        $siswas = User::with('kelas')->where('nis', '!=', 'admin')->get();
        $title = 'Data Siswa';
        return view('admin.master.data_siswa', compact('siswas', 'title'));
    }

    public function store(Request $request){
        $request->validate([
            'nis' => 'required',
            'nisn' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'kelas_id' => 'required',
        ]);
        User::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'gender' => $request->gender,
            'kelas_id' => $request->kelas_id,
        ]);
        return back()->with('success', 'Siswa baru berhasil ditambahkan');
    }

    public function show($id){
        $siswa = User::with('kelas')->where('id', $id)->first();
        return response()->json($siswa, 200);
    }

    public function update(Request $request){
        $siswa = User::where('id', $request->id)->first();
        if($siswa){
            $siswa->update($request->all());
            return back()->with('success', 'Data siswa berhasil diperbarui');
        }
    }

    public function importData(Request $request){
        $request->validate([
            'file_siswa' => 'mimes:xls,xlsx'
        ], [
            'file_siswa.mimes' => 'File ditolak, hanya menerima file excel'
        ]);
        $data = $request->file('file_siswa');
        $file_name = $data->getClientOriginalName();
        $data->move('Data_Siswa', $file_name);
        Excel::import(new SiswaImport(), \public_path('/Data_Siswa/' . $file_name));

        return back()->with('success', 'Data Siswa Berhasil Di Import');
    }

    public function exportData(){
        $siswas = User::with('kelas')->where('nis', '!=', 'admin')->get();
        $title = 'Cetak Data Siswa';
        return view('admin.master.data_siswa_export', compact('siswas', 'title'));
    }

    public function cetak(){
        $siswas = User::with('kelas')->where('nis', '!=', 'admin')->get();
        $title = "Cetak Semua ID Card";
        return view('admin.master.data_siswa_cetak', compact('siswas', 'title'));
    }

    public function destroy($id){
        $siswa = User::where('id', $id)->first();
        if($siswa){
            $siswa->delete();
            return back()->with('success', 'Data siswa berhasil dihapus');
        }
    }
}
