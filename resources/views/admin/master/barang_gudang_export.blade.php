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
        <h3 class="">Laporan Data Barang Gudang Ajaib TJKT</h3>
        <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
            <div class="">Tanggal Dicetak :</div>
            <span>{{ date('d F Y - H : i') }}</span>
        </div>
        <div class="d-flex flex-column border p-2 w-75 rounded mb-4">
            <div class="fw-bold mb-1">Total Stok Barang Sekarang</div>
            @foreach ($tipe_barangs as $item)
                <div class="d-flex gap-3">
                    <div class="" style="width : 18%">{{ $item->tipe_barang }}</div>
                    <div class="">: {{ $item->total_stok }} Buah</div>
                </div>
            @endforeach
        </div>

        <table class="table table-striped">
            <thead class="bg-primary">
                <th class="text-white">No</th>
                <th class="text-white">Kode Barang</th>
                <th class="text-white">Nama Barang</th>
                <th class="text-white">Tipe Barang</th>
                <th class="text-white">Jumlah Barang</th>
                <th class="text-white">Status Barang</th>
            </thead>
            <tbody>
                @foreach ($barangs as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->tipe_barang->tipe_barang }}</td>
                        <td>{{ $item->jumlah_satuan }}</td>
                        <td>{{ $item->status_barang }}</td>
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
