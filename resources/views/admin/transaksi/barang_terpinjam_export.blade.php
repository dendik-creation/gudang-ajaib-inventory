<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - {{ date('d F Y') }}</title>
    <link rel="stylesheet" href="/assets/compiled/css/app.css">

</head>

<body class="bg-white">
    <div class="mt-4">
        <h3 class="">Laporan Data Barang Yang Di Pinjam Gudang Ajaib TJKT</h3>
        <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
            <div class="">Tanggal Dicetak :</div>
            <span>{{ date('d F Y - H : i') }}</span>
        </div>
        <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
            <div class="">Jumlah Barang Yang Belum Dikembalikan :</div>
            <span>{{ $barang_pinjams->count() }} Siswa</span>
        </div>

        <table class="table table-striped">
            <thead class="bg-primary">
                <th class="text-white">No</th>
                <th class="text-white">Kode Barang</th>
                <th class="text-white">Nama Barang</th>
                <th class="text-white">Peminjam</th>
                <th class="text-white">Tahun Ajaran</th>
                <th class="text-white">Waktu Peminjaman</th>
            </thead>
            <tbody>
                @foreach ($barang_pinjams as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->barang->kode_barang }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>
                            <ul>
                                <li>{{ $item->user->nama }}</li>
                                <li> {{ $item->user->nis }} | {{ $item->user->kelas->kelas }}</li>
                            </ul>
                        </td>
                        <td>{{ $item->tahun_ajaran->tahun_ajaran }}</td>
                        <td>{{ $item->waktu_pinjam }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.onload = () => window.print()
    </script>
</body>

</html>
