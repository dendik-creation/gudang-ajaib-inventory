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
        <h3 class="">Laporan Data Siswa Gudang Ajaib TJKT</h3>
        <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
            <div class="">Tanggal Dicetak :</div>
            <span>{{ date('d F Y - H : i') }}</span>
        </div>
        <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
            <div class="">Jumlah Siswa Terdata :</div>
            <span>{{ $siswas->count() }} Siswa</span>
        </div>

        <table class="table table-striped">
            <thead class="bg-primary">
                <th class="text-white">No</th>
                <th class="text-white">NIS</th>
                <th class="text-white">NISN</th>
                <th class="text-white">Nama</th>
                <th class="text-white">Gender</th>
                <th class="text-white">Kelas</th>
            </thead>
            <tbody>
                @foreach ($siswas as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->nisn }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->kelas->kelas }}</td>
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
