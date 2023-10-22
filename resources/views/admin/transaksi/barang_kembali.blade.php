@extends('admin.admin_template')
@section('content_admin')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">

    <div class="row">
        <div class="col-12">
            @include('alert')
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Barang Gudang Yang Telah Dikembalikan</h4>
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
                                    <th>Tahun Ajaran</th>
                                    <th>Waktu Pinjam</th>
                                    <th>Waktu Kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang_kembalis as $i =>  $item)
                                    <tr>
                                        <td class="barcode-text">{{ $i + 1 }}</td>
                                        <td>{{ $item->barang->kode_barang }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td>{{ $item->user->nama }} <br> {{ $item->user->kelas->kelas }}</td>
                                        <td>{{ $item->tahun_ajaran->tahun_ajaran }}</td>
                                        <td>{{ date_format(date_create($item->waktu_pinjam), "d M Y | H:i") }}</td>
                                        <td>{{ date_format(date_create($item->waktu_kembali), "d M Y | H:i") }}</td>
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

    {{-- Aksi Dicegah Modal
    <div class="modal fade text-left" id="aksiDiCegah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel19">Informasi Aksi Dicegah</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Barang harus digudang untuk melakukan edit atau hapus data
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-sm-block d-none">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1 btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-sm-block d-none">OK</span>
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Create Data Modal
    <div class="modal fade text-left" id="createBarangModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Barang</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#">
                    @csrf
                    <div class="modal-body">
                        <label for="kode_barang">Kode Barang</label>
                        <div class="form-group">
                            <input required id="kode_barang" name="kode_barang" type="text" class="form-control">
                        </div>
                        <label for="nama_barang">Nama Barang</label>
                        <div class="form-group">
                            <input required id="nama_barang" name="nama_barang" type="text" class="form-control">
                        </div>
                        <label for="satuan_barang">Satuan Barang</label>
                        <div class="form-group">
                            <select required name="satuan_barang" id="satuan_barang" class="form-control">
                                <option value="" selected disabled>Pilih Satuan</option>
                                <option value="satuan">Satuan</option>
                                <option value="kelompok">Kelompok</option>
                            </select>
                        </div>
                        <label for="jumlah_satuan">Jumlah Satuan</label>
                        <div class="form-group">
                            <input required id="jumlah_satuan" name="jumlah_satuan" type="number" class="form-control">
                        </div>

                        <label for="tipe_barang_id">Tipe Barang</label>
                        <div class="form-group">
                            <select required name="tipe_barang_id" id="tipe_barang_id" class="form-control">
                                <option value="" selected disabled>Pilih Tipe Barang</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block" onclick="store()">Tambah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    {{-- Edit Data Modals
    <div class="modal fade text-left" id="editBarangModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Barang</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="" id="edit_id">
                        <label for="kode_barang">Kode Barang</label>
                        <div class="form-group">
                            <input required id="edit_kode_barang" name="kode_barang" type="text"
                                class="form-control">
                        </div>
                        <label for="nama_barang">Nama Barang</label>
                        <div class="form-group">
                            <input required id="edit_nama_barang" name="nama_barang" type="text"
                                class="form-control">
                        </div>
                        <label for="satuan_barang">Satuan Barang</label>
                        <div class="form-group">
                            <select required name="satuan_barang" id="edit_satuan_barang" class="form-control">
                                <option value="" selected disabled>Pilih Satuan Barang</option>
                                <option value="satuan">Satuan</option>
                                <option value="kelompok">Kelompok</option>
                            </select>
                        </div>
                        <label for="jumlah_satuan">Jumlah Satuan</label>
                        <div class="form-group">
                            <input required id="edit_jumlah_satuan" name="jumlah_satuan" type="number"
                                class="form-control">
                        </div>

                        <label for="tipe_barang_id">Tipe Barang</label>
                        <div class="form-group">
                            <select required name="tipe_barang_id" id="edit_tipe_barang_id" class="form-control">
                                <option value="" selected disabled>Pilih Tipe Barang</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block" onclick="update()">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}



    {{-- <script>
        const confirmDeleteYes = document.getElementById("confirm_delete_yes");

        function confirmSubmit(e, id) {
            const deleteBarangForm = document.getElementById(`delete_barang_form_${id}`);
            e.preventDefault();
            confirmDeleteYes.addEventListener('click', () => {
                deleteBarangForm.submit()
            });
        }
    </script> --}}

    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>

    {{-- <script>
        function update() {
            const data = {
                _token: $("[name='_token']").val(),
                id: $("#edit_id").val(),
                kode_barang: $("#edit_kode_barang").val(),
                nama_barang: $("#edit_nama_barang").val(),
                satuan_barang: $("#edit_satuan_barang").val(),
                jumlah_satuan: $("#edit_jumlah_satuan").val(),
                tipe_barang_id: $("#edit_tipe_barang_id").val(),
            }
            $.ajax({
                type: "put",
                url: `{{ url('/admin/barang-gudang/${data.id}') }}`,
                data: data,
                success: function(data) {
                    window.location.reload();
                },
                error: function() {
                    window.location.reload();
                }
            })
        }

        function store() {
            const data = {
                _token: $("[name='_token']").val(),
                kode_barang: $("#kode_barang").val(),
                nama_barang: $("#nama_barang").val(),
                satuan_barang: $("#satuan_barang").val(),
                jumlah_satuan: $("#jumlah_satuan").val(),
                tipe_barang_id: $("#tipe_barang_id").val(),
            }
            $.ajax({
                type: "post",
                url: "{{ url('admin/barang-gudang') }}",
                data: data,
                success: function(data) {
                    window.location.reload();
                }
            })
        }

        function tipeBarangReady(tipe_barang_id) {
            $(tipe_barang_id).empty();
            $("#tipe_barang_id").empty();
            const opt = document.createElement('option');
            opt.value = "Fara";
            opt.innerHTML = "Pilih Tipe Barang";
            $("#tipe_barang_id option[value='Fara']").prop('disabled', true);
            $("#tipe_barang_id").append(opt);
            $.ajax({
                type: 'get',
                url: "{{ url('/tipe-barang') }}",
                success: function(data) {
                    data.forEach((item) => {
                        const opt = document.createElement('option');
                        opt.value = item.id;
                        opt.innerHTML = item.tipe_barang;
                        $("#tipe_barang_id").append(opt);
                        $(tipe_barang_id).append(opt);
                    })
                }
            })
        }

        function edit(id) {
            const tipeBarang = tipeBarangReady("#edit_tipe_barang_id");
            $.ajax({
                type: 'get',
                url: `{{ url('/admin/barang-gudang/${id}') }}`,
                success: function(data) {
                    $("#edit_id").val(data.id);
                    $("#edit_kode_barang").val(data.kode_barang);
                    $("#edit_nama_barang").val(data.nama_barang);
                    $("#edit_satuan_barang").val(data.satuan_barang);
                    $("#edit_jumlah_satuan").val(data.jumlah_satuan);
                    $("#edit_tipe_barang_id").val(data.tipe_barang_id);
                }
            })
        }
    </script> --}}
@endsection
