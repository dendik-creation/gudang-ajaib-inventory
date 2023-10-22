@extends('admin.admin_template')
@section('content_admin')
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./assets/compiled/css/table-datatable-jquery.css">

    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-3 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Siswa</h6>
                                    <h6 class="font-extrabold mb-0">{{ $users }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-3 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Kode Barang</h6>
                                    <h6 class="font-extrabold mb-0">{{ $barangs }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-3 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Barang Di Pinjam</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pinjam_total_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>5 Terbaru Barang Di Pinjam</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive datatable-minimal">
                                <table class="table" id="table">
                                    <thead>
                                        @if ($pinjams->count() > 0)
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Peminjam</th>
                                                <th>Waktu Pinjam</th>
                                            </tr>
                                            @else
                                            <tr>
                                                <th class="text-center">Informasi</th>
                                            </tr>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @if ($pinjams->count() > 0)
                                            @foreach ($pinjams as $i => $item)
                                                <tr>
                                                    <td class="barcode-text">{{ $i + 1 }}</td>
                                                    <td>{{ $item->barang->kode_barang }}</td>
                                                    <td>{{ $item->barang->nama_barang }}</td>
                                                    <td>{{ $item->user->nama }} | {{ $item->user->kelas->kelas }}</td>
                                                    <td>{{ date_format(date_create($item->waktu_pinjam), "d M Y | H:i") }}</td>
                                                </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td class="text-center">Tidak ada barang yang dipinjam</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="container">
                                <div class="container">
                                    <div class="container">
                                        <a class="w-100 btn btn-primary" href="{{ url('/admin/barang-terpinjam') }}">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
