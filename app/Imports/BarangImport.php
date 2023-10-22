<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'kode_barang' => $row[1],
            'nama_barang' => $row[2],
            'satuan_barang' => $row[3],
            'status_barang' => $row[4],
            'jumlah_satuan' => $row[5],
            'tipe_barang_id' => $row[6],
        ]);
    }
}
