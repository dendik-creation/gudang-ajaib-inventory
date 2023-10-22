<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\User;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\TipeBarang;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Kelas::create([
        //     'kelas' => 'ADMIN'
        // ]);

        // User::create([
        //     'nis' => 'admin',
        //     'nama' => 'Admin',
        //     'nisn' => 'admin',
        //     'gender' => 'L',
        //     'kelas_id' => 37,
        //     'password' => bcrypt('admin'),
        // ]);

        // User::create([
        //     'nis' => '0001',
        //     'nama' => 'User 1',
        //     'nisn' => '123456789',
        //     'gender' => 'L',
        //     'kelas_id' => 1,
        // ]);

        // User::create([
        //     'nis' => '0002',
        //     'nama' => 'User 2',
        //     'nisn' => '123456789',
        //     'gender' => 'P',
        //     'kelas_id' => 3,
        // ]);

        // User::create([
        //     'nis' => '0003',
        //     'nisn' => '123456789',
        //     'nama' => 'User 3',
        //     'gender' => 'P',
        //     'kelas_id' => 12,
        // ]);

        // User::create([
        //     'nis' => '0004',
        //     'nisn' => '123456789',
        //     'nama' => 'User 4',
        //     'gender' => 'P',
        //     'kelas_id' => 14,
        // ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2023/2024',
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2024/2025',
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2025/2026',
        ]);

        TipeBarang::create([
            'tipe_barang' => 'Laptop',
            'total_stok' => 5,
        ]);

        TipeBarang::create([
            'tipe_barang' => 'Router',
            'total_stok' => 30,
        ]);

        TipeBarang::create([
            'tipe_barang' => 'Konverter LAN',
            'total_stok' => 30,
        ]);

        Barang::create([
            'kode_barang' => 'LTP-ACER-07',
            'nama_barang' => 'Laptop Acer No 07',
            'satuan_barang' => 'satuan',
            'jumlah_satuan' => 1,
            'tipe_barang_id' => 1,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'LTP-ACER-21',
            'nama_barang' => 'Laptop Acer No 21',
            'satuan_barang' => 'satuan',
            'jumlah_satuan' => 1,
            'tipe_barang_id' => 1,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'LTP-ASUS-29',
            'nama_barang' => 'Laptop Asus No 29',
            'satuan_barang' => 'satuan',
            'jumlah_satuan' => 1,
            'tipe_barang_id' => 1,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'LTP-ASUS-02',
            'nama_barang' => 'Laptop Asus No 02',
            'satuan_barang' => 'satuan',
            'jumlah_satuan' => 1,
            'tipe_barang_id' => 1,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'LTP-ACER-19',
            'nama_barang' => 'Laptop Acer No 19',
            'satuan_barang' => 'satuan',
            'jumlah_satuan' => 1,
            'tipe_barang_id' => 1,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'RTR-BOX-01',
            'nama_barang' => 'Router Box 1',
            'satuan_barang' => 'kelompok',
            'jumlah_satuan' => 10,
            'tipe_barang_id' => 2,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'RTR-BOX-02',
            'nama_barang' => 'Router Box 2',
            'satuan_barang' => 'kelompok',
            'jumlah_satuan' => 10,
            'tipe_barang_id' => 2,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'RTR-BOX-03',
            'nama_barang' => 'Router Box 3',
            'satuan_barang' => 'kelompok',
            'jumlah_satuan' => 10,
            'tipe_barang_id' => 2,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'CONV-LAN-BOX-01',
            'nama_barang' => 'Konverter LAN Box 1',
            'satuan_barang' => 'kelompok',
            'jumlah_satuan' => 10,
            'tipe_barang_id' => 3,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'CONV-LAN-BOX-02',
            'nama_barang' => 'Konverter LAN Box 2',
            'satuan_barang' => 'kelompok',
            'jumlah_satuan' => 10,
            'tipe_barang_id' => 3,
            'status_barang' => 'ada'
        ]);

        Barang::create([
            'kode_barang' => 'CONV-LAN-BOX-03',
            'nama_barang' => 'Konverter LAN Box 3',
            'satuan_barang' => 'kelompok',
            'jumlah_satuan' => 10,
            'tipe_barang_id' => 3,
            'status_barang' => 'ada'
        ]);
    }
}
