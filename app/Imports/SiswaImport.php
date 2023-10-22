<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nis' => $row[1],
            'nisn' => $row[2],
            'nama' => $row[3],
            'gender' => $row[4],
            'kelas_id' => $row[5],
            'password' => $row[6],
        ]);
    }
}
