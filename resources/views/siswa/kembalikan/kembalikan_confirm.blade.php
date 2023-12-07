@extends('siswa.template_siswa')
@section('content')
    <style>
        #remove {
            cursor: pointer;
        }
    </style>

    <h1 class="fw-bold fs-4 mb-2">Konfirmasi Pengembalian Barang</h1>
    <div class="mt-4">
        <div class="container">
            <div class="d-flex justify-content-start align-items-start mb-2">
                <div class="w-50">
                    <table class="table me-5">
                        <tbody>
                            <tr>
                                <th scope="row">NIS / NISN</th>
                                <td>{{ $data->nis }} / {{ $data->nisn }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Gender</th>
                                <td>{{ $data->gender }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kelas</th>
                                <td>{{ $data->kelas->kelas }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if ($barangs->count() > 0)
                        <div class="badge bg-light-success">
                            <span>{{ $barangs->count() }} Barang Tersisa</span>
                        </div>
                    @else
                        <div class="badge bg-light-success">
                            <span>Tidak ada barang yang dipinjam</span>
                        </div>
                    @endif
                    <div class="mt-2">
                        <a href="/kembalikan" class="btn btn-danger w-100 btn-sm">Kembali Menu Utama</a>
                    </div>
                    <div class="mt-3">
                        @include('alert')
                    </div>
                </div>

                {{-- List --}}
                <div class="ms-5 w-75">
                    <h1 class="fw-medium fs-5 mb-3">List Barang Yang Dikembalikan</h1>
                    <form class="form-group" action="{{ url('/kembalikan') }}" method="POST"
                        onsubmit="beforeSubmit({{ $barangs }})">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ $data->id }}">
                        <input type="hidden" name="pinjam_id" id="pinjam_id" value="">
                        <input required placeholder="Scan QR Code atau Barcode" autocomplete="off" autofocus type="text"
                            class="form-control form-control-sm" name="kode_barang" id="kode_barang">
                    </form>
                    <div class="container">
                        <ul class="list-group mt-4" id="list_barang">
                            @foreach ($barangs as $i => $item)
                                <li class="list-group-item">
                                    <small>
                                        <div class="position-absolute d-flex justify-content-center align-items-center h-100 top-50 translate-middle start-0">
                                            <div class="bg-light-success border border-warning rounded px-2 py-2 d-flex justify-content-center align-items-center">
                                                <span class="fs-3">{{ $i + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="ms-4">
                                            <div class="d-flex justify-content-start align-items-center mb-1">
                                                <div class="fw-bold w-25">Nama Barang</div>
                                                <div class="">{{ $item->barang->nama_barang }}</div>
                                            </div>

                                            <div class="d-flex justify-content-start align-items-center mb-1">
                                                <div class="fw-bold w-25">Jumlah Barang</div>
                                                <div class="">{{ $item->barang->jumlah_satuan }} Buah</div>
                                            </div>
                                            <div class="d-flex justify-content-start align-items-center mb-1">
                                                <div class="fw-bold w-25">Waktu Peminjaman</div>
                                                <div class="">{{ $item->waktu_pinjam }}</div>
                                            </div>
                                            <div class="d-flex justify-content-start align-items-center mb-1">
                                                <div class="fw-bold w-25">Keterangan</div>
                                                <div class="">{{ $item->keterangan ? $item->keterangan : '-' }}</div>
                                            </div>
                                        </div>
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const kode_barang = document.getElementById('kode_barang');
        const pinjam_id = document.getElementById('pinjam_id');

        function beforeSubmit(data) {
            const result = data.find(item => item.barang.kode_barang == kode_barang.value);
            if(result){
                pinjam_id.value = result.id;
            }else{
                pinjam_id.value = "sherryl";
            }
        }
    </script>
@endsection
