@extends('admin.admin_template')
@section('content_admin')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">

    <div class="row">
        <div class="col-12">
            @include('alert')
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <div class="">
                        <h4>Total Stok Barang Gudang TJKT</h4>
                        <span>Stok barang mengikuti perubahan total barang yang di pinjam, dikembalikan, dan barang baru yang ditambahkan</span>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTipeModal">
                            <i class="bi bi-plus-square-fill mb-2 me-1"></i>
                            <small>Tipe Baru</small>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-minimal">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tipe ID</th>
                                    <th>Tipe Barang</th>
                                    <th>Total Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipe_barangs as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tipe_barang }}</td>
                                        <td>{{ $item->total_stok }} Buah</td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center gap-2">
                                                <button class="btn btn-light-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editTipeModal" onclick="edit({{ $item->id }})">
                                                    <i class="bi bi-pencil-fill mb-2"></i>
                                                </button>
                                                {{-- <form method="POST" action="{{ url('tipe-barang/' . $item->id) }}"
                                                    data-bs-toggle="modal" id="delete_tipe_form_{{ $item->id }}"
                                                    onsubmit="confirmSubmit(event, {{ $item->id }})"
                                                    data-bs-target="#border-less">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light-danger">
                                                        <i class="bi bi-trash-fill mb-2"></i>
                                                    </button>
                                                </form> --}}
                                            </div>
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

    {{-- Delete Modals --}}
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
                        Apakah Anda Yakin Menghapus Tipe Barang
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tidak</span>
                    </button>
                    <button type="submit" class="btn btn-light-primary ms-1" id="confirm_delete_yes"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Ya, Hapus</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

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

    {{-- Create Data Modal --}}
    <div class="modal fade text-left" id="createTipeModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Tipe Barang</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ url('/tipe-barang') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="tipe_barang">Tipe Barang</label>
                        <div class="form-group">
                            <input required id="tipe_barang" name="tipe_barang" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Data Modals --}}
    <div class="modal fade text-left" id="editTipeModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Tipe Barang</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" onsubmit="update()">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="" id="edit_id">
                        <label for="edit_tipe_barang">Tipe Barang</label>
                        <div class="form-group">
                            <input required id="edit_tipe_barang" name="edit_tipe_barang" type="text"
                                class="form-control">
                        </div>
                        <label for="edit_total_stok">
                            <span>Total Stok </span>
                            <span class="fs-6">
                                <small>
                                    (Mengubah stok secara langsung memungkinkan total stok tidak cocok dengan aslinya, harap berhati-hati)
                                </small>
                            </span>
                        </label>
                        <div class="form-group">
                            <input required id="edit_total_stok" name="edit_total_stok" type="number"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
        const confirmDeleteYes = document.getElementById("confirm_delete_yes");

        function confirmSubmit(e, id) {
            const deleteBarangForm = document.getElementById(`delete_tipe_form_${id}`);
            e.preventDefault();
            confirmDeleteYes.addEventListener('click', () => {
                deleteBarangForm.submit()
            });
        }
    </script>

    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>

    <script>
        function update() {
            const data = {
                _token: $("[name='_token']").val(),
                id: $("#edit_id").val(),
                tipe_barang: $("#edit_tipe_barang").val(),
                total_stok: $("#edit_total_stok").val(),
            }
            $.ajax({
                type: "put",
                url: `{{ url('/tipe-barang/${data.id}') }}`,
                data: data,
                success: function(data) {
                    window.location.reload();
                },
                error: function() {
                    window.location.reload();
                }
            })
        }

        function edit(id) {
            $.ajax({
                type: 'get',
                url: `{{ url('/tipe-barang/${id}') }}`,
                success: function(data) {
                    $("#edit_id").val(data.id);
                    $("#edit_tipe_barang").val(data.tipe_barang);
                    $("#edit_total_stok").val(data.total_stok);
                }
            })
        }
    </script>
@endsection
