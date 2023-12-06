@extends('admin.admin_template')
@section('content_admin')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
    <style>
        #paksa_btn:disabled{
            cursor: not-allowed !important;
            pointer-events: initial;
        }
    </style>
    <div class="row">
        <div class="col-12">
            @include('alert')
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Barang Gudang Yang Di Pinjam</h4>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <a class="btn btn-warning" href="{{ url('/admin/barang-terpinjam/export') }}" target="_blank">
                            <i class="bi bi-file-earmark-arrow-down-fill mb-2 me-1"></i>
                            <small>Export Data Peminjaman</small>
                        </a>
                        <button disabled class="btn btn-success position-relative" id="paksa_btn" data-bs-toggle="modal"
                            data-bs-target="#listPaksaModal">
                            <i class="bi bi-box-seam-fill mb-2 me-1"></i>
                            <small>Paksa Pengembalian</small>
                            <div class="position-absolute px-2 rounded-circle bg-warning text-black" id="container_html_redicheckbox_length" style="top: -12px ; right : -12px">
                                <span class="fw-bold" id="html_redicheckbox_length">0</span>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-minimal">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Peminjam</th>
                                    <th>Keterangan</th>
                                    <th>Waktu Pinjam</th>
                                    <th>Paksa Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang_pinjams as $i => $item)
                                    <tr>
                                        <td class="barcode-text">{{ $i + 1 }}</td>
                                        <td>{{ $item->barang->kode_barang }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td>{{ $item->user->nama }} <br> {{ $item->user->nis }} |
                                            {{ $item->user->kelas->kelas }}</td>
                                        <td>
                                            @if ($item->keterangan)
                                                {{ $item->keterangan }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ date_format(date_create($item->waktu_pinjam), 'd M Y | H:i') }}</td>
                                        <td>
                                            <center>
                                                <input type="checkbox" class="btn-check btn-sm"
                                                oninput="rediCheckboxHandler({{ $item }})"
                                                    id="btncheck{{ $i + 1 }}" value="{{ $item }}"
                                                    name="pinjam_id[]" autocomplete="off">
                                                <label class="btn btn-outline-success rounded-circle"
                                                    for="btncheck{{ $i + 1 }}">
                                                    <i class="bi bi-patch-check fs-5"></i>
                                                </label>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modals
    <div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Apakah Anda Yakin Menghapus Barang
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tidak</span>
                    </button>
                    <button type="button" class="btn btn-light-primary ms-1" id="confirm_delete_yes"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Ya, Hapus</span>
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade text-left" id="listPaksaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel19">Konfirmasi Pengembalian Paksa Barang Gudang</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="fs-6 mb-3">Barang yang siap dipaksa kembali ke gudang</h2>
                    <div class="container">
                        <div class="table-responsive datatable-minimal">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Peminjam</th>
                                    </tr>
                                </thead>
                                <tbody id="container_paksa_barang">
                                    {{-- <tr>
                                        <td>1</td>
                                        <td>Mengkode</td>
                                        <td>Nama</td>
                                        <td>Meminjam</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="#" method="POST" id="formPaksa">
                        @csrf
                        <button type="submit" id="modal_submit_paksa_btn" class="btn btn-success ms-1 text-center"
                            data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-sm-block d-none">Kembalikan Barang Gudang</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>

    <script>
        // $(document).ready(function() {
        //     $('#table').dataTable({
        //         paging : false,
        //     });
        // })
        const formPaksa = document.getElementById('formPaksa');
        let containerPaksaBarang = document.getElementById('container_paksa_barang');
        const paksaBtn = document.getElementById('paksa_btn');
        const modalPaksaBtn = document.getElementById('modal_submit_paksa_btn');
        const checkboxes = document.getElementsByName('pinjam_id[]');
        const htmlRediCheckboxLength = document.getElementById('html_redicheckbox_length')
        let rediCheckbox = [];


        paksaBtn.addEventListener('click', ((e) => {
            containerPaksaBarang.innerHTML = '';
            if (rediCheckbox.length > 0) {
                modalPaksaBtn.classList.remove('d-none');
                rediCheckbox.forEach((item, i) => {
                    let tr =
                        `<tr>
                        <td>${i + 1}</td>
                        <td>${item.barang.kode_barang}</td>
                        <td>${item.barang.nama_barang}</td>
                        <td>${item.user.nis} | ${item.user.nama} | ${item.user.kelas.kelas}</td>
                        </tr>`
                    containerPaksaBarang.innerHTML += tr;
                })
            } else {
                let tr =
                    `<tr rowspan="4" colspan="4">
                        <td>Tidak ada barang yang ditambahkan</td>
                        </tr>`
                containerPaksaBarang.innerHTML = tr;
                modalPaksaBtn.classList.add('d-none');

            }
        }))
        formPaksa.addEventListener('submit', ((e) => {
            e.preventDefault();
            const data = {
                _token: $("[name='_token']").val(),
                data: rediCheckbox
            }
            $.ajax({
                type: "POST",
                url: `{{ url('/admin/kembalikan_paksa') }}`,
                data: data,
                success: function(data) {
                    window.location.reload();
                },
                error: function() {
                    window.location.reload();
                }
            })
        }))

        function rediCheckboxHandler(newItem){
            const index = rediCheckbox.findIndex(item => item.id === newItem.id);
            if(index !== -1){
                rediCheckbox.splice(index, 1)
            }else{
                rediCheckbox.push(newItem);
            }

            // Paksa Btn Check
            if(rediCheckbox.length > 0){
                paksaBtn.removeAttribute('disabled');
            }else{
                paksaBtn.setAttribute('disabled', true);
            }

            // HTML RediCheckbox Length
            $(document).ready(function(){
                if(rediCheckbox.length > 9){
                    $("#container_html_redicheckbox_length").addClass('py-1')
                }else{
                    $("#container_html_redicheckbox_length").removeClass('py-1')
                }

                $("#container_html_redicheckbox_length").html(rediCheckbox.length);
            })
        }

        // function update() {
        //     const data = {
        //         _token: $("[name='_token']").val(),
        //         id: $("#edit_id").val(),
        //         kode_barang: $("#edit_kode_barang").val(),
        //         nama_barang: $("#edit_nama_barang").val(),
        //         satuan_barang: $("#edit_satuan_barang").val(),
        //         jumlah_satuan: $("#edit_jumlah_satuan").val(),
        //         tipe_barang_id: $("#edit_tipe_barang_id").val(),
        //     }
        //     $.ajax({
        //         type: "put",
        //         url: `{{ url('/admin/barang-gudang/${data.id}') }}`,
        //         data: data,
        //         success: function(data) {
        //             window.location.reload();
        //         },
        //         error: function() {
        //             window.location.reload();
        //         }
        //     })
        // }
    </script>
@endsection
